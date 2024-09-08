<?php

namespace App\Form;

use App\Entity\Biography;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class BiographyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'required' => true,
                'label' => 'Texte du contenu',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                    'rows' => 7,
                ],
            ])
            ->add('photo', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Photo du contenu',
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
            ->add('position', NumberType::class, [
                'required' => false,
                'label' => 'Position du contenu',
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
            'data_class' => Biography::class,
        ]);
    }
}
