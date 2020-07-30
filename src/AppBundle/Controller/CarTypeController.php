<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Controller;

use AppBundle\Entity\CarType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CarTypeType;

/**
 * Car controller.
 *
 * @Route("car/type")
 */
class CarTypeController extends Controller
{
    /**
     * @Route("/", name="car_type_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carTypes = $em->getRepository(CarType::class)->findAll();

        /** @var array $deleteForms creating delete forms for each entity */
        $deleteForms = [];
        foreach ($carTypes as $carType) {
            $deleteForms[$carType->getId()] = $this->createDeleteForm($carType)->createView();
        }

        return $this->render('default/nameCrud/index.html.twig', array(
            'entities' => $carTypes,
            'pathLinkEdit' => 'car_type_edit',
            'pathLinkNew' => 'car_type_new',
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * @Route("/new", name="car_type_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function newAction(Request $request)
    {
        $carType = new CarType();
        $form = $this->createForm(CarTypeType::class, $carType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carType);
            $em->flush();

            return $this->redirectToRoute('car_type_index', array('id' => $carType->getId()));
        }

        return $this->render('default/nameCrud/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="car_type_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param CarType $carType
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function editAction(Request $request, CarType $carType)
    {
        $deleteForm = $this->createDeleteForm($carType);
        $editForm = $this->createForm(CarTypeType::class, $carType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_type_index');
        }

        return $this->render('default/nameCrud/edit.html.twig', array(
            'edit_name' => 'rodzaju pojazdu',
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes entity.
     *
     * @Route("/{id}", name="car_type_delete")
     * @Method("DELETE")
     *
     * @param Request $request
     * @param CarType $carType
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \LogicException
     */
    public function deleteAction(Request $request, CarType $carType)
    {
        $form = $this->createDeleteForm($carType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carType);
            $em->flush();
        }

        return $this->redirectToRoute('car_type_index');
    }

    /**
     * Creates a form to delete entity.
     *
     * @param CarType $carType
     *
     * @return \Symfony\Component\Form\FormInterface The form
     */
    private function createDeleteForm(CarType $carType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('car_type_delete', array('id' => $carType->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
