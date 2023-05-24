<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;

class EventOccurenceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
            'attr' => ['class' => 'save form-control mb-3'],
            ]);
        $builder
            ->add('eventDate', DateType::class, [
                'attr' => [
                    'class' => 'save form-control d-flex justify-content-center mb-3',
                ],
                'widget' => 'single_text',
                'data' => new \DateTime(),
            ]);
        $builder
            ->add('eventStart', TimeType::class, [
                'attr' => [
                    'class' => 'save form-control d-flex justify-content-center text-center mb-3 timepicker',
                ],
                'widget' => 'single_text',
            ]);
        $builder->add('Duration', DateIntervalType::class, [
            'with_years'  => false,
            'with_months' => false,
            'with_days' => false,
            'with_minutes'   => true,
            'with_hours'  => true,
            'attr' => [
                'class' => 'save form-control d-flex justify-content-center text-center mb-3 timepicker2',
            ],
            'widget' => 'single_text',
        ]);
        $builder
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save loginButton btn btn-success w-100'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReccuringEventOccurences::class
        ]);
    }
}
