<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Form;

use AppBundle\Dictionary\CarrierStatus;
use AppBundle\Entity\Carrier;
use AppBundle\Entity\CarrierTag;
use AppBundle\Entity\Clause;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CarrierType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['placeholder' => 'Nazwa'],
                'label' => 'Nazwa',
            ])
            ->add('person', TextType::class, [
                'attr' => ['placeholder' => 'Osoba kontaktowa'],
                'label' => 'Osoba kontaktowa',
            ])
            ->add('identifier', TextType::class, [
                'attr' => ['placeholder' => 'Trans ID'],
                'label' => 'Trans ID',
            ])
            ->add('base', TextType::class, [
                'attr' => [
                    'placeholder' => 'Baza',
                    'oninput' => 'this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\..*)\./g, \'$1\');',
                ],
                'label' => 'Baza',
            ])
            ->add('email', EmailType::class, [
                    'attr' => ['placeholder' => 'Email'],
                    'label' => 'Email',
                ]
            )
            ->add('cars', CollectionType::class, [
                    'entry_type' => CarType::class,
                    'entry_options' => [
                        'attr' => ['class' => 'form-row col-sm-12 new-car'],
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'label' => false,
                ]
            )
            ->add('relations', CollectionType::class, [
                    'entry_type' => RelationType::class,
                    'entry_options' => [
                        'attr' => ['class' => 'form-row col-sm-12 new-relation'],
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'label' => false,
                ]
            )
            ->add('phone', NumberType::class, [
                    'attr' => ['placeholder' => 'Telefon'],
                    'label' => 'Telefon',
                ]
            )
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Nowy' => CarrierStatus::_NEW,
                    'Zamknięty' => CarrierStatus::_CLOSED,
                    'Otwarty' => CarrierStatus::_OPEN,
                    'W trakcie' => CarrierStatus::_PROCEEDED
                ],
                'attr' => ['placeholder' => 'Status'],
                'label' => 'Status'
                ]
            )
            ->add('clauses', EntityType::class, [
                'class' => Clause::class,
                'choice_label' => 'content',
                'expanded' => true,
                'multiple' => true,
                'label' => 'Klauzule',
            ])
            ->add('tags', EntityType::class, [
                'class' => CarrierTag::class,
                'choice_label' => 'tag',
                'multiple' => true,
                'attr' => [
                    'class' => 'tags',
                    'data-placeholder' => 'Tagi',
                ],
                'required' => false,
                'label' => 'Tagi',
            ])
            ->add('submit', SubmitType::class, [
                    'attr' => array('class' => 'form-row btn btn-success btn-block btn-flat'),
                    'label' => 'Zapisz'
                ]
            );

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Carrier::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_carrier';
    }


}
