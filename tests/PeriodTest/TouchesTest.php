<?php

namespace Tests\PeriodTest;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class TouchesTest extends TestCase
{
    public function testPeriodTouchesAnotherPeriod(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2023-01-05 00:00:00', '2023-01-07 23:59:59');

        $this->assertTrue($period->touches($anotherPeriod));
    }

    public function testPeriodTouchesAnotherPeriodInverted(): void
    {
        $period = Period::create('2023-01-05 00:00:00', '2023-01-07 23:59:59');
        $anotherPeriod = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');

        $this->assertTrue($period->touches($anotherPeriod));
    }

    public function testPeriodTouchesAnotherPeriodByASecond(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2023-01-10 23:59:59', '2023-01-17 23:59:59');

        $this->assertTrue($period->touches($anotherPeriod));
    }

    public function testPeriodDoesNotTouchesAnotherPeriod(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2024-10-15 00:00:00', '2024-10-17 23:59:59');

        $this->assertFalse($period->touches($anotherPeriod));
    }

    public function testPeriodDoesNotTouchesAnotherPeriodInverted(): void
    {
        $period = Period::create('2024-10-15 00:00:00', '2024-10-17 23:59:59');
        $anotherPeriod = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');

        $this->assertFalse($period->touches($anotherPeriod));
    }

    public function testPeriodDoesNotTouchesAnotherPeriodByASecond(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:58');
        $anotherPeriod = Period::create('2023-01-10 23:59:59', '2023-10-17 23:59:59');

        $this->assertFalse($period->touches($anotherPeriod));
    }

    public function testPeriodTouchesAnotherPeriodContained(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2023-01-03 12:51:03', '2023-01-07 21:05:07');

        $this->assertTrue($period->touches($anotherPeriod));
    }

    public function testPeriodTouchesAnotherPeriodContainedInverted(): void
    {
        $period = Period::create('2023-01-03 12:51:03', '2023-01-07 21:05:07');
        $anotherPeriod = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');

        $this->assertTrue($period->touches($anotherPeriod));
    }
}
