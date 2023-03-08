<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\TextType;    
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotBlank;

use App\Entity\MotsInterdits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MotsInterditsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('motInterdit', TextareaType::class, [
            'label' => 'Ajouter un mot interdit'
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Ajouter'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MotsInterdits::class,
        ]);
    }
}
