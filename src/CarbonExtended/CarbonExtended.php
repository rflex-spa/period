<?php

namespace Rflex\CarbonExtended;

use Carbon\Carbon;

class CarbonExtended extends Carbon
{
    /**
     * Retrieve the total number of seconds from the Time object.
     */
    public function getSeconds(): int
    {
        return ($this->hour * 60 * 60) + ($this->minute * 60) + $this->second;
    }
}
