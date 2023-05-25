<?php

namespace App\Recurrence;

class RecurringService
{
    const TYPES = [
        "weekly" => RecurrenceWeekly::class,
    ];

    public function getRecurrence(string $type): Recurrence
    {
        $class = self::TYPES[$type] ?? RecurrenceWeekly::class;
        return new $class;
    }
}
