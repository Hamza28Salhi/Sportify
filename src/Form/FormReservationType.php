<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Evenement;




class FormReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
            ->add('id_reservation')
            ->add('date_reservation')
            ->add('heure_d')
            ->add('heure_f')
            ->add('type_sport')
            ->add('cout')
            ->add('evenement',EntityType::class,
               ['class'=>Evenement::class,
             'choice_label'=>'id_evenement',
        'multiple'=>false]) 
            ->add('save',SubmitType::class)
                    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
