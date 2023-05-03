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
     * By default unifies without intersection between the periods, but it can be pointed to check intersection.
     */
    public function union(Period $period, $intersects = false): Period|null
    {
        if ($intersects) {
            if (!$this->intersects($period))
                return null;
        }

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
     * Checks if a period intersects with another period.
     */
    public function intersects(Period $period): bool
    {
        return (is_null($this->intersection($period))) ? false : true;
    }

    /**
     * Subtract two periods and returns the:
     * Total time of the resultant periods
     * An array with all the periods
     */
    public function difference(Period $subtractingPeriod): array|null {
        if ($this->intersects($subtractingPeriod)) {
            // The period holds the subtracting period.
            if ($this->has($subtractingPeriod)) {
                $first = Period::create($this->getStartDate(), $subtractingPeriod->getStartDate()->subSeconds(1));
                $second = Period::create($subtractingPeriod->getEndDate()->addSeconds(1), $this->getEndDate());

                return [($first->getSeconds() + $second->getSeconds()), 'periods' => array($first, $second)];
            }

            // The period was subtracted on it's entirety.
            if ($subtractingPeriod->has($this)) {
                return null;
            }

            // The subtracting period is at the end of the period.
            if ($this->contains($subtractingPeriod->getStartDate())) {
                $result = Period::create($this->getStartDate(), $subtractingPeriod->getStartDate()->subSeconds(1));
    
                return [$result->getSeconds(), 'periods' => array($result)];
            }

            // The subtracting period is at the beginning of the period.
            if ($this->contains($subtractingPeriod->getEndDate())) {
                $result = Period::create($subtractingPeriod->getEndDate()->addSeconds(1), $this->getEndDate());
    
                return [$result->getSeconds(), 'periods' => array($result)];
            }
        }

        return null;
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
