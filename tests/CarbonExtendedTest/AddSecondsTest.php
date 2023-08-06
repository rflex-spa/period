<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class AddSecondsTest extends TestCase
{
    public function testAddSecondsToTheStart(): void
    {
        $period = Period::create('2023-01-01 00:00:51', '2023-01-10 16:41:21');
        $period->addSeconds(35, true, false);

        $expected = Period::create('2023-01-01 00:01:26', '2023-01-10 16:41:21');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testAddSecondsToTheEnd(): void
    {
        $period = Period::create('2023-01-01 18:20:55', '2023-01-10 01:49:44');
        $period->addSeconds(201, false, true);

        $expected = Period::create('2023-01-01 18:20:55', '2023-01-10 01:53:05');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testMoveThePeriodSixtyEightSecondsForward(): void
    {
        $period = Period::create('2023-01-01 15:41:14', '2023-01-10 20:54:06');
        $period->addSeconds(68, true, true);

        $expected = Period::create('2023-01-01 15:42:22', '2023-01-10 20:55:14');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }
}
