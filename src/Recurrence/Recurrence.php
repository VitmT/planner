<?php

namespace App\Recurremnce;

use DateTimeImmutable;

abstract class Recurrence{

    abstract public function getNextTimestamp(
        $baseDate, $now, $lastOccurence):DateTimeImmutable;

}
