<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Form;

use AppBundle\Entity\CarBuild;
use AppBundle\Entity\CarEquipment;
use AppBundle\Entity\CarType as CarTypeEntity;
use AppBundle\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CarrierSearchType
 * @package AppBundle\Form
 */
class CarrierSearchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('base', TextType::class, [
                'attr' => [
                    'placeholder' => 'Baza',
                ],
                'label' => 'Baza',
                'required' => false
            ])
            ->add('fromLocation', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'code',
                'placeholder' => 'Z kraj / nazwa relacji',
                'required' => false,
            ])
            ->add('destinations', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'code',
                'label' => 'Cel / destynacja',
                'placeholder' => 'Cel / destynacja',
                'required' => false
            ])
            ->add('type', EntityType::class, [
                    'class' => CarTypeEntity::class,
                    'choice_label' => 'name',
                    'label' => 'Typ pojazdu',
                    'placeholder' => 'Typ pojazdu',
                    'required' => false
                ]
            )
            ->add('build', EntityType::class, [
                    'class' => CarBuild::class,
                    'choice_label' => 'name',
                    'label' => 'Typ zabudowy',
                    'placeholder' => 'Typ zabudowy',
                    'required' => false
                ]
            )
            ->add('equipments', EntityType::class, [
                    'class' => CarEquipment::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'label' => 'Wyposażenie',
                    'placeholder' => 'Wyposażenie',
                    'required' => false
                ]
            )
            ->add('paletteCapacityFrom', IntegerType::class, [
                    'label' => 'Palety od',
                    'attr' => [
                        'placeholder' => 'max palet',
                        'title' => 'pojemność, miejsca paletowe (euro paleta)',
                    ],
                    'required' => false
                ]
            )
            ->add('paletteCapacityTo', IntegerType::class, [
                    'label' => 'Palety do',
                    'attr' => [
                        'placeholder' => 'max palet',
                        'title' => 'pojemność, miejsca paletowe (euro paleta)',
                    ],
                    'required' => false
                ]
            )
            ->add('quantity', IntegerType::class, [
                    'label' => 'Ilość samochodów',
                    'attr' => [
                        'placeholder' => 'Ilość',
                        'title' => 'ilość',
                    ],
                    'required' => false
                ]
            )
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary btn-block btn-flat'],
                'label' => 'Szukaj'
            ]);

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_carriersearch';
    }
}
