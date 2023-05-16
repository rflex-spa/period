<?php

namespace Rflex;

use Carbon\Carbon;

class Time extends Carbon
{
    public function difference(Time $endTime): ?int
    {
        if ($this->equalTo($endTime))
            return 24;
        
        if ($this->lessThan($endTime))
            return $this->diffInHours($endTime);

        if ($this->greaterThan($endTime))
            return 

        return null;
    }
}
