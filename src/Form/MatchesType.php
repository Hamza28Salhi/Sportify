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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
            ->add('video', FileType::class, [
                'required' => false, // Make the video field optional
                'label' => 'Video (MP4 file)', // Customize the label
            ])
        
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
