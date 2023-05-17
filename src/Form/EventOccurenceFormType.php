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
            ->add('jmenoUdalosti')
        ;
        $builder
            ->add('datum',  DateType::class)
        ;
        $builder
            ->add('zacatek', TimeType::class)
        ;
        $builder
            ->add('konec', TimeType::class)
        ;
        $builder
            ->add('misto')
        ;
        $builder
            ->add('ulozit', SubmitType::class, [
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
