<?php

namespace Tests\PeriodTest;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class IntersectsTest extends TestCase
{
    public function testPeriodIntersectsAnotherPeriod(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2023-01-05 00:00:00', '2023-01-07 23:59:59');

        $this->assertTrue($period->intersects($anotherPeriod));
    }

    public function testPeriodIntersectsAnotherPeriodInverted(): void
    {
        $period = Period::create('2023-01-05 00:00:00', '2023-01-07 23:59:59');
        $anotherPeriod = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');

        $this->assertTrue($period->intersects($anotherPeriod));
    }

    public function testPeriodIntersectsAnotherPeriodByASecond(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2023-01-10 23:59:59', '2023-01-17 23:59:59');

        $this->assertTrue($period->intersects($anotherPeriod));
    }

    public function testPeriodDoesNotIntersectsAnotherPeriod(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2024-10-15 00:00:00', '2024-10-17 23:59:59');

        $this->assertFalse($period->intersects($anotherPeriod));
    }

    public function testPeriodDoesNotIntersectsAnotherPeriodInverted(): void
    {
        $period = Period::create('2024-10-15 00:00:00', '2024-10-17 23:59:59');
        $anotherPeriod = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');

        $this->assertFalse($period->intersects($anotherPeriod));
    }

    public function testPeriodDoesNotIntersectsAnotherPeriodByASecond(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:58');
        $anotherPeriod = Period::create('2023-01-10 23:59:59', '2023-10-17 23:59:59');

        $this->assertFalse($period->intersects($anotherPeriod));
    }

    public function testPeriodIntersectsAnotherPeriodContained(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2023-01-03 12:51:03', '2023-01-07 21:05:07');

        $this->assertTrue($period->intersects($anotherPeriod));
    }

    public function testPeriodIntersectsAnotherPeriodContainedInverted(): void
    {
        $period = Period::create('2023-01-03 12:51:03', '2023-01-07 21:05:07');
        $anotherPeriod = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');

        $this->assertTrue($period->intersects($anotherPeriod));
    }
}
