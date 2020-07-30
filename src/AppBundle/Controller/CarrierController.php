<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Entity\Carrier;
use AppBundle\Form\CarrierType;
use AppBundle\Service\CarrierCollectionChange;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $carrier = new Carrier();
        $form = $this->createForm(CarrierType::class, $carrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($carrier->getCars() as $re) {
                $re->setCarrier($carrier);
            }
            foreach ($carrier->getRelations() as $relation) {
                $relation->setCarrier($carrier);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($carrier);
            $em->flush();

            return $this->redirectToRoute('carrier_show', array('id' => $carrier->getId()));
        }

        return $this->render('carrier/new.html.twig', array(
            'carrier' => $carrier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a carrier entity.
     *
     * @Route("/{id}", name="carrier_show")
     * @Method("GET")
     *
     * @param Carrier $carrier
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Carrier $carrier)
    {
        $deleteForm = $this->createDeleteForm($carrier);

        return $this->render('carrier/show.html.twig', array(
            'carrier' => $carrier,
            'delete_form' => $deleteForm->createView(),
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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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
     * @return \Symfony\Component\Form\FormInterface The form
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
}
