<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Form;

use AppBundle\Entity\CarrierForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CarrierFormType
 *
 * @package AppBundle\Form
 */
class CarrierFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('carrierName', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nazwa',
                ],
            ])
            ->add('carrierIdentifier', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'ID',
                ],
            ])
            ->add('carrier', CarrierRelationType::class, [
                'label' => false
            ])
            ->add('submit', SubmitType::class, [
                'attr' => array('class' => 'btn btn-primary btn-block btn-flat'),
                'label' => 'Zapisz i generuj link'
            ]);
    }

    /**
     * {@inheritdoc}
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CarrierForm::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_carrierform';
    }

}
