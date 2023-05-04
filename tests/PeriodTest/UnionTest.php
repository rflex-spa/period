<?php

namespace Tests\PeriodTest;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class UnionTest extends TestCase
{
    public function testUnion(): void
    {
        $period = Period::create('2023-01-01 05:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2023-01-05 00:00:00', '2023-01-18 12:00:00');

        $union = $period->union($anotherPeriod);

        $this->assertEquals('2023-01-01 05:00:00', $union->getStartDate()->toDateTimeString());
        $this->assertEquals('2023-01-18 12:00:00', $union->getEndDate()->toDateTimeString());
    }

    public function testUnionInverted(): void
    {
        $period = Period::create('2023-01-05 00:00:00', '2023-01-18 12:00:00');
        $anotherPeriod = Period::create('2023-01-01 05:00:00', '2023-01-10 23:59:59');

        $union = $period->union($anotherPeriod);

        $this->assertEquals('2023-01-01 05:00:00', $union->getStartDate()->toDateTimeString());
        $this->assertEquals('2023-01-18 12:00:00', $union->getEndDate()->toDateTimeString());
    }

    public function testUnionWithNotIntersectedPeriods(): void
    {
        $period = Period::create('2023-01-01 05:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2023-01-15 00:00:00', '2023-01-23 12:00:00');

        $union = $period->union($anotherPeriod);

        $this->assertEquals('2023-01-01 05:00:00', $union->getStartDate()->toDateTimeString());
        $this->assertEquals('2023-01-23 12:00:00', $union->getEndDate()->toDateTimeString());
    }

    public function testUnionWithNotIntersectedPeriodsInverted(): void
    {
        $period = Period::create('2023-01-15 00:00:00', '2023-01-23 12:00:00');
        $anotherPeriod = Period::create('2023-01-01 05:00:00', '2023-01-10 23:59:59');

        $union = $period->union($anotherPeriod);

        $this->assertEquals('2023-01-01 05:00:00', $union->getStartDate()->toDateTimeString());
        $this->assertEquals('2023-01-23 12:00:00', $union->getEndDate()->toDateTimeString());
    }

    public function testUnionWithNotIntersectedPeriodsPointingToOnlyIntersectedPeriods(): void
    {
        $period = Period::create('2023-01-01 05:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2023-01-15 00:00:00', '2023-01-23 12:00:00');

        $union = $period->union($anotherPeriod, true);

        $this->assertnull($union);
    }

    public function testUnionWithSamePeriod(): void
    {
        $period = Period::create('2023-01-01 05:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2023-01-01 05:00:00', '2023-01-10 23:59:59');

        $union = $period->union($anotherPeriod);

        $this->assertEquals('2023-01-01 05:00:00', $union->getStartDate()->toDateTimeString());
        $this->assertEquals('2023-01-10 23:59:59', $union->getEndDate()->toDateTimeString());
    }
}
