<?php

namespace App\Recurrence;

use DateTimeImmutable;

abstract class Recurrence
{
    abstract public function getNextTimestamp(
        $baseDate, $now, $lastOccurence):DateTimeImmutable;

}
