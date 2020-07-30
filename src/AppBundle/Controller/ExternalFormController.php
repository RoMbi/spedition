<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Carrier;
use AppBundle\Entity\Relation;
use AppBundle\Form\CarrierType;
use AppBundle\Form\RelationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ExternalFormController
 * @package AppBundle\Controller
 * @Route("form")
 */
class ExternalFormController extends Controller
{
    /**
     * Creates a new carrier entity.
     *
     * @Route("/form", name="external_form_carrier")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $carrier = new Carrier();
        $form = $this->createForm(CarrierType::class, $carrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($carrier->getCars() as $car) {
                $car->setCarrier($carrier);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($carrier);
            $em->flush();

            return $this->redirectToRoute('external_form_relation', array('carrierId' => $carrier->getId()), 307);
        }

        return $this->render('carrier/new.html.twig', array(
            'carrier' => $carrier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new carrier entity.
     *
     * @Route("/form", name="external_form_relation")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addRelationAction(Request $request)
    {
        if (!$request->get('carrierId')) {
            throw new \BadMethodCallException('Nieprawidłowe wywołanie.');
        }
        $carrierId = $request->get('carrierId');
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
}
