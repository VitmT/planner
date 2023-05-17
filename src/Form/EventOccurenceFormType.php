<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventOccurenceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('eventName')
        ;
        $builder
            ->add('eventDate', DateType::class, [
                'attr' => ['class' => 'save dateSelect'],
            ]);
        $builder
            ->add('eventStart', TimeType::class, [
                'attr' => ['class' => 'save dateSelect'],
            ]);
        $builder
            ->add('eventEnd', TimeType::class, [
                'attr' => ['class' => 'save dateSelect'],
            ]);
        $builder
            ->add('eventPlace');
        $builder
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save btn btn-success'],
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
