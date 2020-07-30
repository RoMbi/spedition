<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Form;

use AppBundle\Entity\CarBuild;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CarBuildType
 * @package AppBundle\Form
 */
class CarBuildType extends AbstractType
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
                'label' => 'Rodzaj zabudowy',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CarBuild::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_carbuild';
    }


}
