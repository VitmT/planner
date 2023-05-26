<?php

namespace App\Form;

use App\Entity\ReccuringEventOccurence;
use DateInterval;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException as ExceptionUnexpectedTypeException;
use Symfony\Component\Form\FormInterface;

class EventOccurenceFormType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'timestamp',
            DateType::class,
            [
            'label' => 'Datum',
            'attr' => [
                'class' => 'form-control mb-3',
            ],
            'widget' => 'single_text',
            ]
        );

        $builder->add(
            'startTimeOffset',
            TimeType::class,
            [
            'label' => 'Start Time',
            'attr' => [
                'class' => 'form-control mb-3 timepicker',
            ],
            'widget' => 'single_text',
            ]
        );

        $builder->add(
            'endTimeOffset',
            TimeType::class,
            [
            'label' => 'Duration',
            'attr' => [
                'class' => 'form-control mb-3 timepicker',
            ],
            'widget' => 'single_text',
            ]
        );


        $builder->add(
            'save',
            SubmitType::class,
            [
                'label' => 'Uložit',
                'attr' => [
                    'class' => 'btn btn-success btn-login text-uppercase fw-bold form-control',
                ],
            ]
        );
        $builder->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
            'data_class' => ReccuringEventOccurence::class,
            ]
        );
    }

    public function mapDataToForms($viewData, iterable $forms): void
    {
        // there is no data yet, so nothing to prepopulate
        if (null === $viewData) {
            return;
        }

        // invalid data type
        if (!$viewData instanceof ReccuringEventOccurence) {
            throw new ExceptionUnexpectedTypeException($viewData, ReccuringEventOccurence::class);
        }

        /**
         * @var FormInterface[] $forms
        */
        $forms = iterator_to_array($forms);

        $startDateTime = $viewData->getTimestamp();
        $duration = $viewData->getDuration();
        
        // initialize form field values
        $forms['timestamp']->setData(new DateTime($startDateTime->format('d-m-Y')));
        $forms['startTimeOffset']->setData($viewData->getTimestamp());
        $date = DateTime::createFromInterface(
            $viewData->getTimestamp()
        );
        if ($duration < 0) {
            $method = 'sub';
            $duration = -$duration;
        } else {
            $method = 'add';
        }
        $date->$method(new DateInterval(sprintf('PT%dS', $duration)));

        $forms['endTimeOffset']->setData($date);
    }

    public function mapFormsToData(iterable $forms, &$viewData): void
    {
        /**
         * @var FormInterface[] $forms
        */
        $forms = iterator_to_array($forms);

        $date = $forms['timestamp']->getData();
        $startTime = $forms['startTimeOffset']->getData();
        $endTime = $forms['endTimeOffset']->getData();

        $startDateTime = new DateTime($date->format('d-m-Y') . ' ' . $startTime->format('H:i:s'));
        $viewData->setTimestamp($startDateTime);

        $duration = $endTime->getTimestamp() - $startTime->getTimestamp();
        $viewData->setDuration($duration);
    }
}
