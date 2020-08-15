<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Controller;

use AppBundle\Dictionary\CarrierStatus;
use AppBundle\Entity\Carrier;
use AppBundle\Entity\CarrierForm;
use AppBundle\Form\CarrierCustomerFirstType;
use AppBundle\Form\CarrierCustomerLastType;
use AppBundle\Form\CarrierCustomerSecondType;
use AppBundle\Service\CarrierCollectionChange;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class carrierCustomerController
 *
 * @Route("form")
 *
 * @package AppBundle\Controller
 */
class CarrierCustomerController extends Controller
{
    /**
     * @Route("/", name="carrier_customer_index")
     * @Method("GET")
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function indexAction()
    {
        throw new NotFoundHttpException('Błędne wywołanie strony!');
    }

    /**
     * @Route("/{code}", name="carrier_customer_new")
     * @Method({"GET", "POST"})
     *
     * @param CarrierForm $carrierForm
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function newAction(CarrierForm $carrierForm, Request $request, $code)
    {
        if($carrierForm->isProcessed()){
            return $this->render('carrier/customer/success.html.twig');
        }
        if ($carrierForm->getCarrier() instanceof Carrier) {
            $carrier = $carrierForm->getCarrier();
            if($carrier->getStatus() === CarrierStatus::_NEW) {
                $carrier->setStatus(CarrierStatus::_OPEN);
                $em = $this->getDoctrine()->getManager();
                $em->persist($carrier);
                $em->flush();
            }
        } else {
            $carrier = new Carrier();
            $carrier
                ->setIdentifier($carrierForm->getCarrierIdentifier())
                ->setName($carrierForm->getCarrierName());
        }

        $form = $this->createForm(CarrierCustomerFirstType::class, $carrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->validateData($carrierForm, $carrier);

            $carrierForm->setCarrier($carrier);
            $carrier->setStatus(CarrierStatus::_PROCEEDED);

            $em = $this->getDoctrine()->getManager();
            $em->persist($carrier);
            $em->flush();

            return $this->redirectToRoute('carrier_customer_second', ['code' => $carrierForm->getCode(), 'carrier_id' => $carrier->getId()]);
        }

        return $this->render('carrier/customer/new.html.twig', array(
            'carrier' => $carrier,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{code}/{carrier_id}", name="carrier_customer_second")
     * @Entity("carrier", expr="repository.find(carrier_id)")
     * @Method({"GET", "POST"})
     *
     * @param CarrierForm $carrierForm
     * @param Carrier $carrier
     * @param Request $request
     * @param CarrierCollectionChange $carrierCollectionChange
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function secondStep(CarrierForm $carrierForm, Carrier $carrier, Request $request, CarrierCollectionChange $carrierCollectionChange)
    {
        $this->validateData($carrierForm, $carrier);
        $originalCars = new ArrayCollection();

        // Create an ArrayCollection of the current Car objects in the database
        foreach ($carrier->getCars() as $car) {
            $originalCars->add($car);
        }

        $form = $this->createForm(CarrierCustomerSecondType::class, $carrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->validateData($carrierForm, $carrier);
            $carrierCollectionChange->handleCars($carrier, $originalCars);

            $em = $this->getDoctrine()->getManager();
            $em->persist($carrier);
            $em->flush();

            return $this->redirectToRoute('carrier_customer_last', ['code' => $carrierForm->getCode(), 'carrier_id' => $carrier->getId()]);
        }

        return $this->render('carrier/customer/secondStep.html.twig', array(
            'carrier' => $carrier,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/final/{code}/{carrier_id}", name="carrier_customer_last")
     * @Entity("carrier", expr="repository.find(carrier_id)")
     * @Method({"GET", "POST"})
     *
     * @param CarrierForm $carrierForm
     * @param Carrier $carrier
     * @param Request $request
     * @param CarrierCollectionChange $carrierCollectionChange
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function lastStep(CarrierForm $carrierForm, Carrier $carrier, Request $request, CarrierCollectionChange $carrierCollectionChange, \Swift_Mailer $mailer)
    {
        $this->validateData($carrierForm, $carrier);
        $originalRelations = new ArrayCollection();

        // Create an ArrayCollection of the current Car objects in the database
        foreach ($carrier->getRelations() as $car) {
            $originalRelations->add($car);
        }
        $form = $this->createForm(CarrierCustomerLastType::class, $carrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->validateData($carrierForm, $carrier);

            $carrierCollectionChange->handleRelations($carrier, $originalRelations);

            $carrierForm->setProcessed(1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($carrier);
            $em->flush();

            $carrierName = $carrier->getName();
            $message = (new \Swift_Message('[SYSTEM] Rejestracja użytkownika ' . $carrierName))
                ->setFrom('system@lforce.pl')
                ->setTo('system@lforce.pl')
                ->setBody(
                    $this->renderView(
                        'emails/confirm.html.twig',
                        array(
                            'carrier' => $carrier,
                        )
                    ),
                    'text/html'
                );
            $mailer->send($message);

            return $this->render('carrier/customer/success.html.twig');
        }
        return $this->render('carrier/customer/lastStep.html.twig', array(
            'carrier' => $carrier,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param CarrierForm $carrierForm
     * @param Carrier $carrier
     *
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    private function validateData(CarrierForm $carrierForm, Carrier $carrier)
    {
        // if (!($carrierForm->getCarrierName() === $carrier->getName() && $carrierForm->getCarrierIdentifier() === $carrier->getIdentifier())) {
        //     throw new LogicException('Próba manipulacji danych!');
        // }
    }
}
