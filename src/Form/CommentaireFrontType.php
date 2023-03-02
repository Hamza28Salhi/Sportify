<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommentaireFrontType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu_Commentaire', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champ contenu ne peut pas être vide.',
                    ]),
                ],
            ])
            ->add('auteur_Commentaire', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champ auteur ne peut pas être vide.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'commentaire_item',
        ]);
    }
}
