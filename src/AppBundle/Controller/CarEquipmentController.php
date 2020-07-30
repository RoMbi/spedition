<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Controller;

use AppBundle\Entity\CarEquipment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CarEquipmentType;

/**
 * Car controller.
 *
 * @Route("car/equipment")
 */
class CarEquipmentController extends Controller
{
    /**
     * @Route("/", name="car_equipment_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carEquipments = $em->getRepository(CarEquipment::class)->findAll();

        /** @var array $deleteForms creating delete forms for each entity */
        $deleteForms = [];
        foreach ($carEquipments as $carEquipment) {
            $deleteForms[$carEquipment->getId()] = $this->createDeleteForm($carEquipment)->createView();
        }

        return $this->render('default/nameCrud/index.html.twig', array(
            'entities' => $carEquipments,
            'pathLinkEdit' => 'car_equipment_edit',
            'pathLinkNew' => 'car_equipment_new',
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * @Route("/new", name="car_equipment_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function newAction(Request $request)
    {
        $carEquipment = new CarEquipment();
        $form = $this->createForm(CarEquipmentType::class, $carEquipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carEquipment);
            $em->flush();

            return $this->redirectToRoute('car_equipment_index', array('id' => $carEquipment->getId()));
        }

        return $this->render('default/nameCrud/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="car_equipment_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param CarEquipment $carEquipment
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function editAction(Request $request, CarEquipment $carEquipment)
    {
        $deleteForm = $this->createDeleteForm($carEquipment);
        $editForm = $this->createForm(CarEquipmentType::class, $carEquipment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_equipment_index');
        }

        return $this->render('default/nameCrud/edit.html.twig', array(
            'edit_name' => 'wyposażenia',
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes entity.
     *
     * @Route("/{id}", name="car_equipment_delete")
     * @Method("DELETE")
     *
     * @param Request $request
     * @param CarEquipment $carEquipment
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \LogicException
     */
    public function deleteAction(Request $request, CarEquipment $carEquipment)
    {
        $form = $this->createDeleteForm($carEquipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carEquipment);
            $em->flush();
        }

        return $this->redirectToRoute('car_equipment_index');
    }

    /**
     * Creates a form to delete entity.
     *
     * @param CarEquipment $carEquipment
     *
     * @return \Symfony\Component\Form\FormInterface The form
     */
    private function createDeleteForm(CarEquipment $carEquipment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('car_equipment_delete', array('id' => $carEquipment->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
