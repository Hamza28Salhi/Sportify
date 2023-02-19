<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;      //
use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotBlank;


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_Post')
           /* ->add('titre_Post', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Titre manquant'
                    ])
                ]
            ])*/
            ->add('contenu_Post')
            ->add('auteur_Post')
            ->add('image_Post', FileType::class, [
                'required' => false,
                'label' => 'Image du Post'
            ])
            ->add('save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
