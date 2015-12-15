<?php

namespace LpdwBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('content', 'text')
            ->add('content', TextareaType::class, array(
                'required' => false // Pas de validation HTML5
            ))
            ->add('author', TextType::class, array(
                'required' => false // Pas de validation HTML5
            ))
            ->add('visible', ChoiceType::class, array(
                'required' => false,
                'choices' => array(
                    'yes' => 'Oui',
                    'no'  => 'Non'
                ),
                'multiple' => false, // Pas de choix multiple
                'expanded' => true   // Pas de select
            ))
            ->add('date', DateType::class, array(
                'required' => false
            ))
            ->add('submit', SubmitType::class, array('label' => 'Envoyer'))
        ;
    }
}
