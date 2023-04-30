<?php

namespace Rflex\CarbonExtended;

use Carbon\CarbonPeriod;

class CarbonPeriodExtended extends CarbonPeriod
{
    /**
     * Add one day to the Carbon period.
     */
    public function addDay(bool $start, bool $end): void {
        if ($start) {
            $this->setStartDate($this->getStartDate()->addDay());
        }

        if ($end) {
            $this->setEndDate($this->getEndDate()->addDay());
        }
    }

    /**
     * Add a number of days to the period.
     */
    public function addDays(int $days, bool $start, bool $end): void {
        if ($start) {
            $this->setStartDate($this->getStartDate()->addDays($days));
        }

        if ($end) {
            $this->setEndDate($this->getEndDate()->addDays($days));
        }
    }

    /**
     * Subtract one day to the period.
     */
    public function subDay(bool $start, bool $end): void {
        if ($start) {
            $this->setStartDate($this->getStartDate()->subDay());
        }

        if ($end) {
            $this->setEndDate($this->getEndDate()->subDay());
        }
    }

    /**
     * Subtract a number of days to the period.
     */
    public function subDays(int $days, bool $start, bool $end): void {
        if ($start) {
            $this->setStartDate($this->getStartDate()->subDays($days));
        }

        if ($end) {
            $this->setEndDate($this->getEndDate()->subDays($days));
        }
    }

    /**
     * Returns the total number of seconds of the period.
     */
    public function getSeconds(): int {
        return $this->getEndDate()->diffInSeconds($this->getStartDate());
    }

    /**
     * Returns the total number of minutes of the period.
     */
    public function getMinutes(): int {
        return $this->getEndDate()->diffInMinutes($this->getStartDate());
    }

    /**
     * Returns the total number of hours of the period.
     */
    public function getHours(): int {
        return $this->getEndDate()->diffInHours($this->getStartDate());
    }

    /**
     * Set the length of the period in seconds from the start.
     */
    public function setLengthInSeconds(int $seconds): void {
        $this->setEndDate($this->getStartDate()->addSeconds($seconds));
    }

    /**
     * Set the length of the period in minutes from the start.
     */
    public function setLengthInMinutes(int $minutes): void {
        $this->setEndDate($this->getStartDate()->addMinutes($minutes));
    }

    /**
     * Set the length of the period in hours from the start.
     */
    public function setLengthInHours(int $hours): void {
        $this->setEndDate($this->getStartDate()->addHours($hours));
    }
}