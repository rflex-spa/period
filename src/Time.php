<?php

namespace Rflex;

use Rflex\CarbonExtended\CarbonExtended;

class Time extends CarbonExtended
{
    public static function createFromSeconds(int $seconds): Time
    {
        $hours = (int) floor($seconds / 3600);
        $minutes = (int) floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;

        return self::createFromTime($hours, $minutes, $seconds);
    }

    public function difference(Time $endTime): Time
    {
        // If the start time is greater than the end time, we need to calculate the difference
        // by (total seconds in a day) - (difference between times)
        if ($this->greaterThan($endTime)) {
            return self::createFromSeconds((24 * 60 * 60) - $endTime->diffInSeconds($this));
        } else {
            return self::createFromSeconds($this->diffInSeconds($endTime));
        }
    }
}
