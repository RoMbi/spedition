<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Form;

use AppBundle\Entity\Carrier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CarrierCustomerType
 * @package AppBundle\Form
 */
class CarrierCustomerFirstType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identifier', TextType::class, [
                'attr' => [
                    'placeholder' => 'Trans ID',
                    'readonly' => true,
                ],
                'label' => 'Trans ID',
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nazwa',
                    'readonly' => true,
                ],
                'label' => 'Nazwa',
            ])
            ->add('person', TextType::class, [
                'attr' => [
                    'placeholder' => 'Osoba kontaktowa',
                    'minlength' => 4
                ],
                'label' => 'Osoba kontaktowa',
            ])
            ->add('base', TextType::class, [
                'attr' => [
                    'placeholder' => 'Baza (kod pocztowy)',
                    'maxlength' => 5,
                    'oninput' => 'this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\..*)\./g, \'$1\');',
                ],
                'label' => 'Baza (kod pocztowy)',
            ])
            ->add('email', EmailType::class, [
                    'attr' => ['placeholder' => 'Email'],
                    'label' => 'Email',
                ]
            )->add('phone', NumberType::class, [
                    'attr' => [
                        'placeholder' => 'Telefon',
                        'oninput' => 'this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\..*)\./g, \'$1\');',
                        'minlength' => 6,
                        'maxlength' => 11,
                    ],
                    'label' => 'Telefon',
                ]
            )
            ->add('submit', SubmitType::class, [
                    'attr' => array('class' => 'form-row btn btn-success btn-block btn-flat'),
                    'label' => 'Dalej'
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Carrier::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_carriercustomer_firsttype';
    }
}
