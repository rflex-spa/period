<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class AddMinutesTest extends TestCase
{
    public function testAddMinutesToTheStart(): void
    {
        $period = Period::create('2023-06-13 00:00:51', '2023-06-16 16:41:21');
        $period->addMinutes(22, true, false);

        $expected = Period::create('2023-06-13 00:22:51', '2023-06-16 16:41:21');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testAddMinutesToTheEnd(): void
    {
        $period = Period::create('2023-06-13 18:20:55', '2023-06-16 01:49:44');
        $period->addMinutes(86, false, true);

        $expected = Period::create('2023-06-13 18:20:55', '2023-06-16 03:15:44');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testMoveThePeriodHundredAndFiveMinutesForward(): void
    {
        $period = Period::create('2023-06-13 15:41:14', '2023-06-16 20:54:06');
        $period->addMinutes(105, true, true);

        $expected = Period::create('2023-06-13 17:26:14', '2023-06-16 22:39:06');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }
}
