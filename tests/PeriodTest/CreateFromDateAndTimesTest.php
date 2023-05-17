<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Date;
use Rflex\Period;
use Rflex\Time;

final class CreateFromDateAndTimesTest extends TestCase
{
    public function testCreateFromDateAndTimes(): void
    {
        $startDate = Date::createFromFormat('Y-m-d', '2023-05-17');

        $startTime = Time::createFromTimeString('09:00');
        $endTime = Time::createFromTimeString('20:00');

        $period = Period::createFromDateAndTimes($startDate, $startTime, $endTime);

        $this->assertEquals('2023-05-17 09:00:00', $period->getStartDate());
        $this->assertEquals('2023-05-17 20:00:00', $period->getEndDate());
        $this->assertEquals(39600, $period->getSeconds());
    }

    public function testCreateFromDateAndTimesLessThan(): void
    {
        $startDate = Date::createFromFormat('Y-m-d', '2023-05-17');

        $startTime = Time::createFromTimeString('20:00');
        $endTime = Time::createFromTimeString('09:00');

        $period = Period::createFromDateAndTimes($startDate, $startTime, $endTime);

        $this->assertEquals('2023-05-17 20:00:00', $period->getStartDate());
        $this->assertEquals('2023-05-18 09:00:00', $period->getEndDate());
        $this->assertEquals(46800, $period->getSeconds());
    }
}
