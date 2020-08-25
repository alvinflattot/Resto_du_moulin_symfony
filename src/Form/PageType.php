<?php

namespace App\Form;

use App\Entity\Page;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('title', TextType::class, [
                'label' => 'titre',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner un titre de page'
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Le titre de la page doit contenir au moins {{ limit }} caractères',
                        'max' => 100,
                        'maxMessage' => 'Le titre de la page doit contenir au maximum {{ limit }} caractères'
                    ]),
                ]
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'Contenu',
                'purify_html' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner un contenu'
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Le message doit contenir au moins 1 caractère',
                        'max' => 10000,
                        'maxMessage' => 'Le message doit contenir au maximum {{ limit }} caractères'
                    ]),
                ]
            ])

            //bouton envoyer
            ->add('send', SubmitType::class,[
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-outline-primary col-12',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }
}
