<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class SubSecondsTest extends TestCase
{
    public function testSubSecondsToTheStart(): void
    {
        $period = Period::create('2023-01-01 00:02:30', '2023-01-10 12:51:10');
        $period->subSeconds(3, true, false);

        $expected = Period::create('2023-01-01 00:02:27', '2023-01-10 12:51:10');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testSubSecondsToTheEnd(): void
    {
        $period = Period::create('2023-01-01 10:14:51', '2023-01-10 14:52:38');
        $period->subSeconds(4, false, true);

        $expected = Period::create('2023-01-01 10:14:51', '2023-01-10 14:52:34');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testMoveThePeriodEightySecondsBackward(): void
    {
        $period = Period::create('2023-01-01 15:11:42', '2023-01-10 00:00:20');
        $period->subSeconds(80, true, true);

        $expected = Period::create('2023-01-01 15:10:22', '2023-01-09 23:59:00');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }
}
