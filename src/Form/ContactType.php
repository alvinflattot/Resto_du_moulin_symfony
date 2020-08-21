<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;




class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            // prénom*
            ->add('firstname', TextType::class, [
                'label' => 'Prénom*',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner un prénom'
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Le prénom doit contenir au moins {{ limit }} caractères',
                        'max' => 150,
                        'maxMessage' => 'Le prénom doit contenir au maximum {{ limit }} caractères'
                    ]),
                ]
            ])

            //nom*
            ->add('lastname', TextType::class, [
                'label' => 'Nom*',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner un nom'
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                        'max' => 150,
                        'maxMessage' => 'Le nom doit contenir au maximum {{ limit }} caractères'
                    ]),
                ]
            ])
            
            //adresse
            ->add('adress', TextType::class, [
                'label' => 'Adresse',
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage' => 'L\'adresse doit contenir au moins {{ limit }} caractères',
                        'max' => 200,
                        'maxMessage' => 'L\'adresse doit contenir au maximum {{ limit }} caractères'
                    ]),
                ]
            ])

            //code postal
            ->add('zipcode', TextType::class, [
                'required' => false,
                'label' => 'Code postal',
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Le code postal doit contenir au moins {{ limit }} caractères',
                        'max' => 5,
                        'maxMessage' => 'Le code postal doit contenir au maximum {{ limit }} caractères'
                    ]),
                    new Regex([
                        'pattern' => "/^[1-9][0-9]{4}$/",
                        'message' => 'Code postal invalide ! '
                    ])
                ]
            ])

            //ville
            ->add('city', TextType::class, [
                'required' => false,
                'label' => 'Vile',
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage' => 'La ville doit contenir au moins {{ limit }} caractères',
                        'max' => 58,
                        'maxMessage' => 'La ville doit contenir au maximum {{ limit }} caractères'
                    ]),
                ]
            ])

            //téléphone
            ->add('phone', TextType::class, [
                'required' => false,
                'label' => 'Téléphone',
                'constraints' => [
                    new Regex([
                        'pattern' => "/^([0-9]{2}[ -.]?){4}[0-9]{2}$/",
                        'message' => 'Numéro de téléphone invalide ! '
                    ]),
                ]
            ])

            //adresse mail
            ->add('email', EmailType::class, [
                'label' => 'Adresse Email*',
                'constraints' => [
                    new Email([
                        'message' => 'L\'adresse email {{ value }} n\'est pas une adresse valide'
                    ]),
                    new NotBlank([
                        'message' => 'Merci de renseigner une adresse email'
                    ])
                ],
            ])
            
            //message
            ->add('message', TextareaType::class, [
                'label' => 'Message*',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner un message'
                    ]),
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Le message doit contenir au moins 1 caractère',
                        'max' => 2000,
                        'maxMessage' => 'Le message doit contenir au maximum {{ limit }} caractères'
                    ]),
                ]
            ])

            //bouton envoyer
            ->add('send', SubmitType::class,[
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-outline-primary col-12',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
