<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Form;

use AppBundle\Entity\CarEquipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CarEquipmentType
 * @package AppBundle\Form
 */
class CarEquipmentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Nazwa',
                ),
                'label' => 'Wyposażenie',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CarEquipment::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_carequipment';
    }


}
