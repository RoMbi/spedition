<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Controller;

use AppBundle\Dictionary\CarrierStatus;
use AppBundle\Entity\Car;
use AppBundle\Entity\Carrier;
use AppBundle\Entity\CarrierForm;
use AppBundle\Entity\CarrierTag;
use AppBundle\Form\CarrierType;
use AppBundle\Service\CarrierCollectionChange;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Carrier controller.
 *
 * @Route("carrier")
 */
class CarrierController extends Controller
{
    /**
     * Lists all carrier entities.
     *
     * @Route("/", name="carrier_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carriers = $em->getRepository('AppBundle:Carrier')->findAll();

        return $this->render('carrier/index.html.twig', array(
            'carriers' => $carriers,
        ));
    }

    /**
     * Creates a new carrier entity.
     *
     * @Route("/new", name="carrier_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $carrier = new Carrier();
        $form = $this->createForm(CarrierType::class, $carrier);
        $form->handleRequest($request);
        $createdBy = $this->get('security.token_storage')->getToken()->getUser()->getUsername();

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($carrier->getCars() as $re) {
                $re->setCarrier($carrier);
            }
            foreach ($carrier->getRelations() as $relation) {
                $relation->setCarrier($carrier);
            }

            $carrier
                ->setStatus(CarrierStatus::_CLOSED)
                ->setCreatedBy($createdBy)
                ->setCreatedAt(new DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($carrier);
            $em->flush();

            $carrierForm = new CarrierForm();
            $carrierForm
                ->setCarrierName($carrier->getName())
                ->setCarrier($carrier)
                ->setCarrierIdentifier($carrier->getIdentifier())
                ->generateCode();
            $this->validateCode($carrierForm);

            $em = $this->getDoctrine()->getManager();
            $em->persist($carrierForm);
            $em->flush();

            return $this->redirectToRoute('carrier_show', array('id' => $carrier->getId()));
        }

        return $this->render('carrier/new.html.twig', array(
            'carrier' => $carrier,
            'form' => $form->createView(),
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

    /**
     * Finds and displays a carrier entity.
     *
     * @Route("/{id}", name="carrier_show")
     * @Method("GET")
     *
     * @param Carrier $carrier
     *
     * @return Response
     */
    public function showAction(Carrier $carrier, $id)
    {

        $deleteForm = $this->createDeleteForm($carrier);

        $em = $this->getDoctrine()->getManager();

        $code = $em->createQuery(
            'SELECT cf.code
            FROM AppBundle:Carrier c
            JOIN AppBundle:CarrierForm cf
            WHERE c.id = cf.carrier
            AND c.id = :id
            '
        )->setParameter('id', $id)->getOneOrNullResult();

        if($code != null) {
            $code = implode(" ", $code);
        }


        return $this->render('carrier/show.html.twig', array(
            'carrier' => $carrier,
            'delete_form' => $deleteForm->createView(),
            'code' => $code
        ));
    }

    /**
     * Displays a form to edit an existing carrier entity.
     *
     * @Route("/{id}/edit", name="carrier_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Carrier $carrier
     * @param CarrierCollectionChange $carrierCollectionChange
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Carrier $carrier, CarrierCollectionChange $carrierCollectionChange)
    {
        $originalCars = new ArrayCollection();
        $originalRelations = new ArrayCollection();

        // Create an ArrayCollection of the current Car objects in the database
        foreach ($carrier->getCars() as $car) {
            $originalCars->add($car);
        }

        // Create an ArrayCollection of the current Destination objects in the database
        foreach ($carrier->getRelations() as $relation) {
            $originalRelations->add($relation);
        }


        $deleteForm = $this->createDeleteForm($carrier);
        $editForm = $this->createForm(CarrierType::class, $carrier);
        $editForm->handleRequest($request);
//        $this->saveNewTags($request, $carrier);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $carrierCollectionChange->handleCars($carrier, $originalCars);
            $carrierCollectionChange->handleRelations($carrier, $originalRelations);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carrier_show', array('id' => $carrier->getId()));
        }

        return $this->render('carrier/edit.html.twig', array(
            'carrier' => $carrier,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a carrier entity.
     *
     * @Route("/{id}", name="carrier_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Carrier $carrier
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Carrier $carrier)
    {
        $form = $this->createDeleteForm($carrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carrier);
            $em->flush();
        }

        return $this->redirectToRoute('carrier_index');
    }

    /**
     * Creates a form to delete a carrier entity.
     *
     * @param Carrier $carrier The carrier entity
     *
     * @return FormInterface The form
     */
    private function createDeleteForm(Carrier $carrier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('carrier_delete', array('id' => $carrier->getId())))
            ->setMethod('DELETE')
            ->setAttribute('single', true)
            ->getForm()
        ;
    }

    private function saveNewTags(Request $request, Carrier $carrier)
    {
        $tags = $request->request->get('appbundle_carrier')['tags'];
        if(!is_array($tags)) {
            return;
        }

        foreach ($tags as $tag) {
            if (!is_numeric($tag)) {
                $newTag = new CarrierTag();
                $newTag->setTag($tag);
                $this->getDoctrine()->getManager()->persist($newTag);
                $carrier->addTag($newTag);
            }
        }
        $this->getDoctrine()->getManager()->flush();
//        $request->request->get('appbundle_carrier')['tags'] = null;
    }

    /**
     * @Route("/addTag")
     * @Method({"GET", "POST", "DELETE"})
     * @param Request $request
     *
     * @return Response
     */
    public function addTagAction(Request $request)
    {
        $tag = $request->get('tag');
        $carrierTagRepository = $this->getDoctrine()->getManager()->getRepository(CarrierTag::class);
        $existedTag = $carrierTagRepository->findOneBy(['tag' => $tag]);
        if ($existedTag) {
            return new JsonResponse(
                ['tagId' => $existedTag->getId()]
            );
        }

        $newTag = new CarrierTag();
        $newTag->setTag($tag);
        $this->getDoctrine()->getManager()->persist($newTag);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(
            ['tagId' => $newTag->getId()]
        );
    }
}
