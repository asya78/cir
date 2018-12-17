<?php

namespace CirTuSofiaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestHallType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'widget' => 'single_text',

                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,

                'format' => 'd-M-y',

                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker']
            ))
            ->add('timeStart', TimeType::class, array(
                'widget' => 'single_text',
                'data_class' => null,
                'html5' => false

            ))
            ->add('timeEnd', TimeType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'data_class' => null
            ))
            ->add('description', TextareaType::class, ['data'=>null]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CirTuSofiaBundle\Entity\RequestHall'
        ));
    }

}
