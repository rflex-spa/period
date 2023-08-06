<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class SubMinutesTest extends TestCase
{
    public function testSubMinutesToTheStart(): void
    {
        $period = Period::create('2023-01-01 00:02:30', '2023-01-10 12:51:10');
        $period->subMinutes(3, true, false);

        $expected = Period::create('2022-12-31 23:59:30', '2023-01-10 12:51:10');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testSubMinutesToTheEnd(): void
    {
        $period = Period::create('2023-01-01 10:14:51', '2023-01-10 14:52:38');
        $period->subMinutes(40, false, true);

        $expected = Period::create('2023-01-01 10:14:51', '2023-01-10 14:12:38');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testMoveThePeriodEightyMinutesBackward(): void
    {
        $period = Period::create('2023-01-01 15:11:42', '2023-01-10 00:00:20');
        $period->subMinutes(80, true, true);

        $expected = Period::create('2023-01-01 13:51:42', '2023-01-09 22:40:20');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }
}
