<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Controller;

use AppBundle\Dictionary\CarrierStatus;
use AppBundle\Entity\Carrier;
use AppBundle\Entity\CarrierForm;
use AppBundle\Entity\Relation;
use AppBundle\Form\CarrierFormType;
use AppBundle\Form\CarrierRelationType;
use AppBundle\Form\CarrierType;
use AppBundle\Form\RelationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("carrier/form")
 */
class CarrierFormController extends Controller
{
    /**
     * @Route("/new", name="carrier_form_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $carrierForm = new CarrierForm();
        $form = $this->createForm(CarrierFormType::class, $carrierForm);
        $form->handleRequest($request);
        $creatorName = $this->get('security.token_storage')->getToken()->getUser()->getUsername();

        if ($form->isSubmitted() && $form->isValid()) {

            $carrierForm->generateCode();
            $this->validateCode($carrierForm);

            $carrier = new Carrier();
            $carrier
                ->setIdentifier($carrierForm->getCarrierIdentifier())
                ->setName($carrierForm->getCarrierName())
                ->setStatus(CarrierStatus::_NEW)
                ->setCreatedBy($creatorName);


            $em = $this->getDoctrine()->getManager();
            $em->persist($carrier);
            $em->flush();

            foreach ($carrierForm->getCarrier()->getRelations() as $relation) {
                $relation->setCarrier($carrier);
                $carrier->addRelation($relation);
            }

            $carrierForm->setCarrier($carrier);
            $em->persist($carrierForm);
            $em->flush();

            return $this->redirectToRoute('carrier_form_show', array('id' => $carrierForm->getId()));
        }

        return $this->render('carrierForm/new.html.twig', array(
            'carrierForm' => $carrierForm,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}", name="carrier_form_show")
     * @Method({"GET", "POST"})
     *
     * @param CarrierForm $carrierForm
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(CarrierForm $carrierForm)
    {
        return $this->render('carrierForm/show.html.twig', array(
            'code' => $carrierForm->getCode(),
        ));
    }

    /**
     * @param CarrierForm $carrierForm
     */
    private function validateCode(CarrierForm $carrierForm)
    {
        if($this->isDuplicate($carrierForm)){
            $carrierForm->regenerateCode();
            $this->validateCode($carrierForm);
        }
    }

    /**
     * @param CarrierForm $carrierForm
     * @return bool
     */
    private function isDuplicate(CarrierForm $carrierForm)
    {
        $em = $this->getDoctrine()->getManager();
        return (boolean)$em->getRepository(CarrierForm::class)->findOneBy(['code' => $carrierForm->getCode()]);
    }
}
