<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Form;

use AppBundle\Dictionary\Location as LocationDictionary;
use AppBundle\Entity\CarBuild;
use AppBundle\Entity\CarEquipment;
use AppBundle\Entity\CarrierTag;
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
use Doctrine\ORM\EntityRepository;

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
            ->add('fromLocations', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'code',
                'multiple' => true,
                'label' => 'Z kraj / nazwa relacji',
                'attr' => [
                    'data-placeholder' => 'Skąd',
                ],
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.code', 'ASC');
                },
            ])
            ->add('destinations', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'code',
                'multiple' => true,
                'label' => 'Cel / destynacja',
                'attr' => [
                    'data-placeholder' => 'Dokąd',
                ],
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.code', 'ASC');
                },
            ])
            ->add('type', EntityType::class, [
                    'class' => CarTypeEntity::class,
                    'multiple' => true,
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
            ->add('tags', EntityType::class, [
                    'class' => CarrierTag::class,
                    'choice_label' => 'tag',
                    'multiple' => false,
                    'label' => 'Tag',
                    'placeholder' => 'Tag',
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
}
