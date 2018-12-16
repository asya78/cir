<?php

namespace CirTuSofiaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HallType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', TextType::class)
            ->add('seats', IntegerType::class)
            ->add('computers', IntegerType::class)
            ->add('laptop', ChoiceType::class, array(
                 'choices' =>array(
                     'Да' => true,
                     'Не' => false
                 ),
                'choice_value' => function ($choice) {
                    return false === $choice ? '0' : (string) $choice;
                },
                'empty_data' => null,
                'choices_as_values' => true,
            ))
            ->add('projector', ChoiceType::class, array(
                'choices' =>array(
                    'Да' => true,
                    'Не' => false
                ),
                'choice_value' => function ($choice) {
                    return false === $choice ? '0' : (string) $choice;
                },
                'empty_data' => null,
                'choices_as_values' => true,
            ))
            ->add('info',TextType::class)
            ->add('image', FileType::class, array('data_class' => null));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CirTuSofiaBundle\Entity\Hall'
        ));
    }




}
