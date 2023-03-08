<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints as Assert;


class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('full_name')
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' =>'the email value is required'
                    ])
                    ],
                    'required' => true,
                    'attr' => [
                        'class' => 'form-control'
                    ]
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'utilisateur' =>'ROLE_USER',
                    'Administrateur' =>'ROLE_ADMIN',
                    'Responsable boutique' =>'ROLE_BOBO'
                ],
                'expanded' =>true,
                'multiple' =>true,
                'label' => 'Roles'
            ]) 
            ->add('date_naiss')
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
            ->add('address')
            
            ->add('Save', SubmitType::class)
        ;
        if ($options['is_bobo']) {
            $builder
            ->add('matr_fisc', TextType::class, [
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^\d{7}\d\/\d\/\d\/\d{3}$/',
                        'message' => 'Please enter a valid string in the format "1234567x/x/x/xxx".'
                    ]),
                    new Assert\Length([
                        'min' => 16,
                        'max' => 16,
                        'exactMessage' => 'Length should be 13'
                    ])
                ]
            ])
            ->add('job_position')
            ->add('prod_category');
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
