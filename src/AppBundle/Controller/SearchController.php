<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Carrier;
use AppBundle\Form\CarrierSearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Search controller.
 *
 * @Route("search")
 */
class SearchController extends Controller
{
    /**
     * @Route("/", name="search_index")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $results = array();
        $anyResult = false;
        $form = $this->createForm(CarrierSearchType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $form->getData();
            $results = $this->getDoctrine()->getManager()->getRepository(Carrier::class)->searchByFormData($form->getData());
            if ($results) {
                $anyResult = true;
            }
        }

        return $this->render('carrier/search.html.twig', array(
            'form' => $form->createView(),
            'results' => $results,
            'anyResult' => $anyResult,
        ));
    }
}
