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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
    public function indexAction(Request $request, \Swift_Mailer $mailer)
    {
        $results = array();
        $anyResult = false;
        $form = $this->createForm(CarrierSearchType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $form->getData();
            $results = $this->getDoctrine()->getManager()->getRepository(Carrier::class)->searchByFormData($form->getData());
            $this->get('session')->set('results', $results);
            if ($results) {
                $anyResult = true;
            }
        }

        $emailForm = $this->createFormBuilder([])
        ->add('title', TextType::class, ['label' => 'Tytuł', 'required' => true])
        ->add('message', TextareaType::class, ['label' => 'Wiadomość', 'required' => true])
        ->add('submit', SubmitType::class, [
            'attr' => ['class' => 'btn btn-primary btn-block btn-flat'],
            'label' => 'Wyślij'
        ])
        ->getForm();

        $emailForm->handleRequest($request);

        if($emailForm->isSubmitted() && $emailForm->isValid()){
            $title = $emailForm->get('title')->getData();
            $messagetext = $emailForm->get('message')->getData();

            $results = $this->get('session')->get('results');
            foreach ($results as $carrier) {
                $message = (new \Swift_Message($title))
                ->setFrom('cargo@lforce.pl')
                ->setTo($carrier->getEmail())
                ->setBody(
                    $this->renderView(
                        'emails/search.html.twig',
                        array(
                            'messagetext' => $messagetext,
                        )
                    ),
                    'text/html'
                );
                $mailer->send($message);
            }
            $this->get('session')->set('results', array());
            $this->addFlash('success', 'Wiadomości email zostały wysłane pomyślnie.');
        }

        return $this->render('carrier/search.html.twig', array(
            'form' => $form->createView(),
            'emailform' => $emailForm->createView(),
            'results' => $results,
            'anyResult' => $anyResult,
        ));
    }
}
