<?php

namespace App\Form;

use App\Entity\Matches;
use App\Entity\Equipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Repository\EquipeRepository;

class MatchesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
            ->add('nom')
            ->add('adversaire')

    
         
         
            ->add('stade')
            ->add('date')
            ->add('score')
            ->add('nom_equipe')
            
        
            ->add('save',SubmitType::class)
        ;
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matches::class,
                'csrf_protection' => false,
            'allow_extra_fields' => true,
            'equipe_repository' => null,
        ]);
    }
}
