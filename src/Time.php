<?php

namespace Rflex;

use Rflex\CarbonExtended\CarbonExtended;

class Time extends CarbonExtended
{
    public function difference(Time $endTime): Duration
    {
        // If the start time is greater than the end time, we need to calculate the difference
        // by (total seconds in a day) - (difference between times)
        if ($this->greaterThan($endTime)) {
            return Duration::createFromSeconds((24 * 60 * 60) - $endTime->diffInSeconds($this));
        } else {
            return Duration::createFromSeconds($this->diffInSeconds($endTime));
        }
    }
}
