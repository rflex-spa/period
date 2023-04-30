<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class SettersTest extends TestCase
{
    public function testSetLengthInSecondsThirtySeconds(): void
    {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->setLengthInSeconds(30);

        $expected = Period::create('2023-01-01 00:00:00', '2023-01-01 00:00:30');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testSetLengthInMinutesFiveMinutes(): void
    {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->setLengthInMinutes(5);

        $expected = Period::create('2023-01-01 00:00:00', '2023-01-01 00:05:00');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testSetLengthInHoursEightHours(): void
    {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->setLengthInHours(8);

        $expected = Period::create('2023-01-01 00:00:00', '2023-01-01 08:00:00');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }
}
