<?php

namespace Rflex;

use Rflex\CarbonExtended\CarbonPeriodExtended;

class Period extends CarbonPeriodExtended
{
    /**
     * Check if the period contains another period inside.
     */
    public function has(Period $period): bool {
        return $this->contains($period->getStartDate()) && $this->contains($period->getEndDate());
    }

    /**
     * Get the shared minutes between two periods if any.
     */
    public function overlappedMinutes(Period $period): int {
        if ($this->has($period)) {
            return $period->getMinutes();
        }

        if ($period->has($this)) {
            return $this->getMinutes();
        }

        if($this->contains($period->getStartDate())) {
            return $this->getEndDate()->diffInMinutes($period->getStartDate());
        }

        if($this->contains($period->getEndDate())) {
            return $period->getEndDate()->diffInMinutes($this->getStartDate());
        }

        return 0;
    }

    /**
     * Checks if a period overlaps with another period, despite the amount of overlapped time.
     */
    public function touches(Period $period): bool {
        return ($this->overlappedMinutes($period) > 0) ? true : false;
    }

    /**
     * Returns the total seconds of difference between the start/end of a period and an event.
     * point = 0 (start)
     * point = 1 (end)
     * 
     * Negative result means that the event is before the period point.
     * Zero means that the event is at the same moment than the period point.
     * Positive result means that the event is after the period point.
     */
    public function differenceWithEvent(Event $event, int $point): int {
        $comparationPoint = ($point === 0) ? $this->getStartDate() : $this->getEndDate();

        return ($event->timestamp - $comparationPoint->timestamp);
    }
}
