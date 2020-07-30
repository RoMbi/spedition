<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Form;

use AppBundle\Entity\Carrier;
use AppBundle\Entity\Clause;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CarrierCustomerLastType
 * @package AppBundle\Form
 */
class CarrierCustomerLastType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('relations', CollectionType::class, [
                    'entry_type' => RelationType::class,
                    'entry_options' => [
                        'attr' => ['class' => 'form-row col-sm-12 new-relation'],
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'label' => false,
                    'required' => true,
                ]
            )
            ->add('clauses', EntityType::class, [
                'class' => Clause::class,
                'choice_label' => 'content',
                'expanded' => true,
                'multiple' => true,
                'label' => 'Klauzule',
                'choice_attr' => function() {
                     return ['required' => true];
                    },
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