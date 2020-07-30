<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Form;

use AppBundle\Entity\Car;
use AppBundle\Entity\CarType as CarTypeEntity;
use AppBundle\Entity\CarBuild;
use AppBundle\Entity\CarEquipment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', EntityType::class, [
                    'class' => CarTypeEntity::class,
                    'choice_label' => 'name',
                    'label' => false,
                    'placeholder' => 'Typ pojazdu',
                    'attr' => [
                        'class' => 'col-sm-2'
                    ],
                ]
            )
            ->add('build', EntityType::class, [
                    'class' => CarBuild::class,
                    'choice_label' => 'name',
                    'label' => false,
                    'placeholder' => 'Typ zabudowy',
                    'attr' => [
                        'class' => 'col-sm-2'
                    ],
                ]
            )
            ->add('equipments', EntityType::class, [
                    'class' => CarEquipment::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'label' => false,
                    'placeholder' => 'Wyposażenie',
                    'attr' => [
                        'class' => 'col-sm-2'
                    ],
                    'required' => false
                ]
            )
            ->add('paletteCapacity', TextType::class, [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'max palet',
                        'title' => 'podaj maksymalną ilość euro palet, która mieści się na pojeździe',
                        'class' => 'col-sm-1',
                        'data-toggle' => 'tooltip',
                        'maxlength' => 3,
                        'oninput' => 'this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\..*)\./g, \'$1\');',
                    ],
                ]
            )
            ->add('length', TextType::class, [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'dł',
                        'title' => 'długość (podaj wymiary przestrzeni ładunkowej w [cm])',
                        'class' => 'col-sm-1',
                        'data-toggle' => 'tooltip',
                        'maxlength' => 4,
                        'oninput' => 'this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\..*)\./g, \'$1\');',
                    ],
                ]
            )
            ->add('width', TextType::class, [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'szer',
                        'title' => 'szerokość (podaj wymiary przestrzeni ładunkowej w [cm])',
                        'class' => 'col-sm-1',
                        'data-toggle' => 'tooltip',
                        'maxlength' => 3,
                        'oninput' => 'this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\..*)\./g, \'$1\');',
                    ],
                ]
            )
            ->add('height', TextType::class, [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'wys',
                        'title' => 'wysokość (podaj wymiary przestrzeni ładunkowej w [cm])',
                        'class' => 'col-sm-1',
                        'data-toggle' => 'tooltip',
                        'maxlength' => 3,
                        'oninput' => 'this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\..*)\./g, \'$1\');',
                    ],
                ]
            )
            ->add('quantity', TextType::class, [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'ilość',
                        'title' => 'podaj ilość pojazdów o podanych wymiarach',
                        'class' => 'col-sm-1',
                        'data-toggle' => 'tooltip',
                        'maxlength' => 3,
                        'oninput' => 'this.value = this.value.replace(/[^0-9]/g, \'\').replace(/(\..*)\./g, \'$1\');',
                    ],
                ]
            )
            ->add('X', ButtonType::class, [
                'attr' => [
                    'class' => 'col-sm-1 btn remove-tag btn-block btn-outline-danger'
                ]
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Car::class,
            'single' => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_car';
    }


}
