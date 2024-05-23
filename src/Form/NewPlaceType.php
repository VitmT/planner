<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\ReccuringEvent;

class NewPlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            'label' => 'Event Name:',
            'attr' => [
                'class' => 'form-control',
                'name' => 'name',
            ],
        ]);

        $builder->add('defaultTimestamp', DateTimeType::class, [
            'label' => 'Default Timestamp:',
            'widget' => 'single_text',
            'attr' => [
                'class' => 'form-control',
                'name' => 'defaultTimestamp',
            ],
        ]);

        $builder->add('reccurenceType', TextType::class, [
            'label' => 'Recurrence Type:',
            'attr' => [
                'class' => 'form-control',
                'name' => 'reccurenceType',
            ],
            'data' => 'weekly',
        ]);

        $builder->add('Submit', SubmitType::class, [
            'attr' => ['class' => 'btn btn-success w-100 mt-3'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReccuringEvent::class,
        ]);
    }
}
