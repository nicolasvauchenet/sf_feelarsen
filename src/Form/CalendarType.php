<?php

namespace App\Form;

use App\Entity\Calendar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom du calendrier',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                ],
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 7,
                ],
            ])
            ->add('poster', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Poster du calendrier',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'attr' => [
                    'class' => 'form-file',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Veuillez choisir une image JPG, PNG ou WebP',
                    ]),
                ],
            ])
            ->add('startAt', null, [
                'widget' => 'single_text',
                'required' => true,
                'label' => 'Date de début',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('endAt', null, [
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Date de fin',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('active', CheckboxType::class, [
                'required' => false,
                'label' => 'Calendrier actif',
                'attr' => [
                    'class' => 'form-checkbox',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
