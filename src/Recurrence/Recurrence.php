<?php

namespace App\Recurrence;

use DateTimeImmutable as DateTime;
use DateInterval;

abstract class Recurrence
{    
    abstract public function getNextTimestamp(DateTime $baseDate, DateTime $now, ?DateTime $lastOccurence): DateTime;

    protected function getReferenceTimestamp(
        DateTime $now,
        ?DateTime $lastOccurence,
        ?DateInterval $interval=null
    ): DateTime {
        if ($lastOccurence === null) {
            return $now;
        }
        if ($interval !== null) {
            $lastOccurence = $lastOccurence->add($interval);
        }
        return ($now > $lastOccurence) ? $now : $lastOccurence;
    }
}
