<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Track;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class TrackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('album', EntityType::class, [
                'required' => true,
                'label' => 'Album associé',
                'class' => Album::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisissez un Album',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'Titre du morceau',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                ],
            ])
            ->add('fileName', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Fichier audio',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'attr' => [
                    'class' => 'form-file',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '15M',
                        'mimeTypes' => [
                            'audio/mpeg',
                        ],
                        'mimeTypesMessage' => 'Veuillez choisir un fichier audio MP3',
                    ]),
                ],
            ])
            ->add('position', NumberType::class, [
                'required' => false,
                'label' => 'Position du morceau',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Track::class,
        ]);
    }
}
