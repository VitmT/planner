<?php

namespace App\Recurrence;

use DateTimeImmutable as DateTime;
use DateInterval;
class RecurrenceWeekly extends Recurrence
{
    public function getNextTimestamp(DateTime $baseDate, DateTime $now, ?DateTime $lastOccurence): DateTime
    {
        $interval = new DateInterval("P2D");
        $referenceTimestamp = $this->getReferenceTimestamp($now, $lastOccurence, $interval);
        $wantedDayOfWeek = (int)$baseDate->format("w");
        $expectedDayOfWeek = (int)$referenceTimestamp->format("w");
        $diff = $wantedDayOfWeek - $expectedDayOfWeek;
        while ($diff < 0) {
            $diff += 7;
        }
        $date = $referenceTimestamp->setTime(
            (int)$baseDate->format("H"),
            (int)$baseDate->format("i"),
            (int)$baseDate->format("s")
        );
        if ($diff > 0) {
            $date = $date->add(new DateInterval("P".$diff."D"));
        }
        if ($date < $referenceTimestamp) {
            $date = $date->add(new DateInterval("P7D"));
        }
        return $date;
    }
}
