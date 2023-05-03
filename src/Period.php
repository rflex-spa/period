<?php

namespace Rflex;

use Rflex\CarbonExtended\CarbonPeriodExtended;

class Period extends CarbonPeriodExtended
{
    /**
     * Check if the period contains another period inside.
     */
    public function has(Period $period): bool
    {
        return $this->contains($period->getStartDate()) && $this->contains($period->getEndDate());
    }

    /**
     * Unify two periods into one. Using the minimum start date and the maximum end date.
     * This unifies any two periods into one, even if they don't overlap.
     */
    public function union(Period $period): Period
    {
        $startDate = $this->getStartDate()->min($period->getStartDate());
        $endDate = $this->getEndDate()->max($period->getEndDate());

        return Period::create($startDate, $endDate);
    }

    /**
     * Get the intersection between two periods if any.
     */
    public function intersection(Period $period): Period|null
    {
        if ($this->has($period)) {
            return $period;
        }

        if ($period->has($this)) {
            return $this;
        }

        if ($this->contains($period->getStartDate()) || $this->contains($period->getEndDate())) {
            $startDate = $this->getStartDate()->max($period->getStartDate());
            $endDate = $this->getEndDate()->min($period->getEndDate());

            return Period::create($startDate, $endDate);
        }

        return null;
    }

    /**
     * Checks if a period overlaps with another period.
     */
    public function touches(Period $period): bool
    {
        return (is_null($this->intersection($period))) ? false : true;
    }

    /**
     * Returns the total seconds of difference between the start/end of a period and an event.
     * point = 0 (start)
     * point = 1 (end).
     *
     * Negative result means that the event is before the period point.
     * Zero means that the event is at the same moment than the period point.
     * Positive result means that the event is after the period point.
     */
    public function differenceWithEvent(Event $event, int $point): int
    {
        $comparationPoint = ($point === 0) ? $this->getStartDate() : $this->getEndDate();

        return $event->timestamp - $comparationPoint->timestamp;
    }
}
