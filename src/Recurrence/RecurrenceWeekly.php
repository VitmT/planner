<?php

namespace App\Recurrence;

use DateTime;
use DateTimeImmutable;

class RecurrenceWeekly extends Recurrence
{
    public function getNextTimestamp(
        $baseDate, $now, $lastOccurence): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }
}
