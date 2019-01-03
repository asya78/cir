<?php

namespace CirTuSofiaBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->
        add('email', TextType::class)->
        add('password', TextType::class)->
        add('fullName', TextType::class)->
        add('roles',IntegerType::class, array('mapped'=>false,'data'=>null))->
        add('status', ChoiceType::class, array(
                'choices' =>array(
                    'Активен' => true,
                    'Неактивен' => false
                ),
                'choice_value' => function ($choice) {
                    return false === $choice ? '0' : (string) $choice;
                },
                'empty_data' => null,
                'choices_as_values' => true,
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CirTuSofiaBundle\Entity\User'
        ));
    }



}
