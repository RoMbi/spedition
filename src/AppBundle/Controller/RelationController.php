<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Carrier;
use AppBundle\Entity\Relation;
use AppBundle\Form\RelationType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Relation controller.
 *
 * @Route("relation")
 */
class RelationController extends Controller
{
    /**
     * Lists all relation entities.
     *
     * @Route("/", name="relation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $relations = $em->getRepository('AppBundle:Relation')->findAll();

        return $this->render('relation/index.html.twig', array(
            'relations' => $relations,
        ));
    }

    /**
     * Creates a new relation entity.
     *
     * @Route("/{carrierId}/new", name="relation_new", requirements={"carrierId"="\d+"})
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param int $carrierId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \InvalidArgumentException
     */
    public function newAction(Request $request, $carrierId)
    {
        $em = $this->getDoctrine()->getManager();
        $carrier = $em->getRepository(Carrier::class)->find($carrierId);

        if (!$carrier instanceof Carrier) {
            throw new \InvalidArgumentException('Brak podanego przewoźnika, id: ' . $carrierId);
        }
        $relation = new Relation();
        $relation->setCarrier($carrier);
        $form = $this->createForm(RelationType::class, $relation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

//            /** @var RelationDestination $destination */
//            foreach ($relation->getDestinations() as $destination) {
//                $destination->setRelation($relation);
//            }

            $em->persist($relation);
            $em->flush();

            return $this->redirectToRoute('carrier_show', array('id' => $relation->getCarrier()->getId()));
        }

        return $this->render('relation/new.html.twig', array(
            'relation' => $relation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a relation entity.
     *
     * @Route("/{id}", name="relation_show")
     * @Method("GET")
     */
    public function showAction(Relation $relation)
    {
        $deleteForm = $this->createDeleteForm($relation);

        return $this->render('relation/show.html.twig', array(
            'relation' => $relation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing relation entity.
     *
     * @Route("/{id}/edit", name="relation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Relation $relation)
    {
        $originalDestinations = new ArrayCollection();

        // Create an ArrayCollection of the current Destination objects in the database
        foreach ($relation->getDestinations() as $destination) {
            $originalDestinations->add($destination);
        }

        $deleteForm = $this->createDeleteForm($relation);
        $editForm = $this->createForm(RelationType::class, $relation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /**
             * handle new Destinations
             */
            foreach ($relation->getDestinations() as $destination) {
//                $relation->removeDestination($destination);
                $destination->setRelation($relation);
            }

//            /**
//             * removing deleted destinations
//             * @var RelationDestination $destination
//             */
//            foreach ($originalDestinations as $destination) {
//                if (false === $relation->getDestinations()->contains($destination)) {
//                    $relation->removeDestination($destination);
//                    $this->getDoctrine()->getManager()->persist($relation);
//                    $this->getDoctrine()->getManager()->remove($destination);
//                    /** nulling carrier from Car instead of deleting entity */
////                    $destination->setRelation(null);
//                }
//            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('relation_edit', array('id' => $relation->getId()));
        }

        return $this->render('relation/edit.html.twig', array(
            'relation' => $relation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a relation entity.
     *
     * @Route("/delete/{id}", name="relation_delete")
     * @Method({"DELETE", "GET"})
     */
    public function deleteAction(Request $request, Relation $relation)
    {
        $form = $this->createDeleteForm($relation);
        $form->handleRequest($request);

        if (($form->isSubmitted() && $form->isValid()) || $request->isMethod('GET')) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($relation);
            $em->flush();
        }

        return $this->redirectToRoute('carrier_show', array('id' => $relation->getCarrier()->getId()));
    }

    /**
     * Creates a form to delete a relation entity.
     *
     * @param Relation $relation The relation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Relation $relation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('relation_delete', array('id' => $relation->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
