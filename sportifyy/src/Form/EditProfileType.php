<?php

namespace App\Form;

use App\Entity\User;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('full_name',TextType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Please add your name',
                ]),
            ],
            
        ])
        ->add('email', EmailType::class, [
            'constraints' => [
                new NotBlank([
                    'message' =>'the email value is required'
                ])
                ],
                'required' => true,
                
        ])
        ->add('user_pic', FileType::class, [
            'label' => 'Image',
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new File([
                    'maxSize' => '1000024k',
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                    ],
                    'mimeTypesMessage' => 'Please upload a valid JPEG or PNG image',
                ])
            ],
        ])
        ->add('date_naiss')
        
        
        ->add('submit', SubmitType::class)
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
