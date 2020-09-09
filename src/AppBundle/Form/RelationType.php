<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Form;

use AppBundle\Dictionary\Location as LocationDictionary;
use AppBundle\Entity\Location;
use AppBundle\Entity\Relation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RelationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fromLocations', EntityType::class, [
                    'class' => Location::class,
                    'choice_label' => 'code',
                    'multiple' => true,
                    'label' => false,
                    'attr' => [
                        'class' => 'col-sm-5',
                        'data-placeholder' => 'Z kraj / nazwa relacji',
                    ],
                    'required' => true,
                ]
            )
            ->add('destinations', EntityType::class, [
                    'class' => Location::class,
                    'choice_label' => 'code',
                    'multiple' => true,
                    'label' => false,
                    'placeholder' => 'Cel / destynacja',
                    'attr' => [
                        'class' => 'col-sm-6',
                        'data-placeholder' => 'Dokąd',
                    ],
                    'required' => true,
                ]
            )
            ->add('X', ButtonType::class, [
                    'attr' => [
                        'class' => 'col-sm-1 btn remove-tag btn-block btn-outline-danger'
                    ]
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Relation::class,
            'single' => true,
        ));
    }

    /**
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach (array_reverse(LocationDictionary::MAIN) as $country) {
            $newChoice = new ChoiceView([], '', $country, ['disabled' => 'disabled']);
            array_unshift($view->children['fromLocations']->vars['choices'], $newChoice);
            array_unshift($view->children['destinations']->vars['choices'], $newChoice);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_relation';
    }
}