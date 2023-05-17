<?php

namespace Rflex;

use Rflex\CarbonExtended\CarbonExtended;

class Duration extends CarbonExtended
{
    public static function createFromSeconds(int $seconds): Duration
    {
        $hours = (int) floor($seconds / 3600);
        $minutes = (int) floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;

        return self::createFromTime($hours, $minutes, $seconds);
    }
}
