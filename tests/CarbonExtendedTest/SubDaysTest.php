<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class SubDaysTest extends TestCase
{
    public function testSubDaysToTheStart(): void
    {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->subDays(3, true, false);

        $expected = Period::create('2022-12-29', '2023-01-10');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testSubDaysToTheEnd(): void
    {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->subDays(4, false, true);

        $expected = Period::create('2023-01-01', '2023-01-06');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testMoveThePeriodEightDaysBackward(): void
    {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->subDays(8, true, true);

        $expected = Period::create('2022-12-24', '2023-01-02');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }
}
