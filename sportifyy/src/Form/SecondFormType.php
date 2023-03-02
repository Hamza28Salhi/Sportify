<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SecondFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
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
            ->add('prod_category')
            
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Agree To Terms' =>'ROLE_BOBO'
                ],
                'expanded' =>true,
                'multiple' =>true,
            ]) 
            ->add('submit',SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
