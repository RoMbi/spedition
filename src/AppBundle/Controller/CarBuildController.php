<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Controller;

use AppBundle\Entity\CarBuild;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CarBuildType;

/**
 * Car controller.
 *
 * @Route("car/build")
 */
class CarBuildController extends Controller
{
    /**
     * @Route("/", name="car_build_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carBuilds = $em->getRepository(CarBuild::class)->findAll();

        /** @var array $deleteForms creating delete forms for each entity */
        $deleteForms = [];
        foreach ($carBuilds as $carBuild) {
            $deleteForms[$carBuild->getId()] = $this->createDeleteForm($carBuild)->createView();
        }

        return $this->render('default/nameCrud/index.html.twig', array(
            'entities' => $carBuilds,
            'pathLinkEdit' => 'car_build_edit',
            'pathLinkNew' => 'car_build_new',
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * @Route("/new", name="car_build_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function newAction(Request $request)
    {
        $carBuild = new CarBuild();
        $form = $this->createForm(CarBuildType::class, $carBuild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carBuild);
            $em->flush();

            return $this->redirectToRoute('car_build_index', array('id' => $carBuild->getId()));
        }

        return $this->render('default/nameCrud/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="car_build_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param CarBuild $carBuild
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function editAction(Request $request, CarBuild $carBuild)
    {
        $deleteForm = $this->createDeleteForm($carBuild);
        $editForm = $this->createForm(CarBuildType::class, $carBuild);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_build_index');
        }

        return $this->render('default/nameCrud/edit.html.twig', array(
            'edit_name' => 'rodzaju zabudowy',
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes entity.
     *
     * @Route("/{id}", name="car_build_delete")
     * @Method("DELETE")
     *
     * @param Request $request
     * @param CarBuild $carBuild
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \LogicException
     */
    public function deleteAction(Request $request, CarBuild $carBuild)
    {
        $form = $this->createDeleteForm($carBuild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carBuild);
            $em->flush();
        }

        return $this->redirectToRoute('car_build_index');
    }

    /**
     * Creates a form to delete entity.
     *
     * @param CarBuild $carBuild
     *
     * @return \Symfony\Component\Form\FormInterface The form
     */
    private function createDeleteForm(CarBuild $carBuild)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('car_build_delete', array('id' => $carBuild->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
