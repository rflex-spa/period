<?php

namespace Rflex;

use Carbon\CarbonPeriod;

class Period extends CarbonPeriod
{
    /**
     * Check if the period has another period inside.
     *
     * @param Period
     *
     * @return bool
     */
    public function has(Period $period) {
        return $this->contains($period->getStartDate()) && $this->contains($period->getEndDate());
    }

    /**
     * Add one day to the period.
     *
     * @return void
     */
    public function addDay() {
        $this->setDates($this->getStartDate()->addDay(), $this->getEndDate()->addDay());
    }

    /**
     * Add a number of days to the period.
     *
     * @param int
     *
     * @return void
     */
    public function addDays(int $days) {
        $this->setDates($this->getStartDate()->addDays($days), $this->getEndDate()->addDays($days));
    }

    /**
     * Subtract one day to the period.
     *
     * @return void
     */
    public function subDay() {
        $this->setDates($this->getStartDate()->subDay(), $this->getEndDate()->subDay());
    }

    /**
     * Subtract a number of days to the period.
     *
     * @param int
     *
     * @return void
     */
    public function subDays(int $days) {
        $this->setDates($this->getStartDate()->subDays($days), $this->getEndDate()->subDays($days));
    }

    /**
     * Returns the total number of minutes of the period.
     *
     * @return int
     */
    public function getMinutes() {
        return $this->getEndDate()->diffInMinutes($this->getStartDate());
    }

    /**
     * Returns the total number of hours of the period.
     *
     * @return int
     */
    public function getHours() {
        return $this->getEndDate()->diffInHours($this->getStartDate());
    }

    /**
     * Get the shared minutes between two periods if any.
     *
     * @param Period
     *
     * @return int
     */
    public function overlappedMinutes(Period $period) {
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
     *
     * @param Period
     *
     * @return boolean
     */
    public function touches(Period $period) {
        return ($this->overlappedMinutes($period) > 0) ? true : false;
    }

    /**
     * Set the length of the period in minutes from the start.
     *
     * @param int
     *
     * @return void
     */
    public function setLengthInMinutes(int $minutes) {
        $this->setEndDate($this->getStartDate()->addMinutes($minutes));
    }

    /**
     * Set the length of the period in hours from the start.
     *
     * @param int
     *
     * @return void
     */
    public function setLengthInHours(int $hours) {
        $this->setEndDate($this->getStartDate()->addHours($hours));
    }
}
