<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Form;

use AppBundle\Entity\Carrier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CarrierCustomerSecondType
 * @package AppBundle\Form
 */
class CarrierCustomerSecondType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
        return 'appbundle_carriercustomer_secondtype';
    }
}