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
            ->add('eventName', TextType::class, [
            'attr' => ['class' => 'save form-control'],
            ]);
        $builder
            ->add('eventDate', DateType::class, [
                'attr' => ['class' => 'save dateSelect form-control'],
            ]);
        $builder
            ->add('eventStart', TimeType::class, [
                'attr' => ['class' => 'save dateSelect form-control'],
            ]);
        $builder->add('Duration', DateIntervalType::class, [
            'widget'      => 'choice',
            'with_years'  => false,
            'with_months' => false,
            'with_days' => false,
            'with_minutes'   => true,
            'with_hours'  => true,
            'attr' => ['class' => 'save dateSelect'],
            'minutes' => [0 => 0, 15 => 15, 30 => 30, 45 => 45],
            'hours' => array_combine(range(0, 5), range(0, 5)),
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
            // Configure your form options here
        ]);
    }
}
