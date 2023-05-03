<?php

namespace Tests\PeriodTest;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class ContainsTest extends TestCase
{
    public function testPeriodContainsAnotherPeriod(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2023-01-05 00:00:00', '2023-01-07 23:59:59');

        $this->assertTrue($period->has($anotherPeriod));
    }

    public function testPeriodContainsAnotherPeriodInverted(): void
    {
        $period = Period::create('2023-01-05 00:00:00', '2023-01-07 23:59:59');
        $anotherPeriod = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');

        $this->assertFalse($period->has($anotherPeriod));
    }

    public function testPeriodDoesNotContainAnotherPeriod(): void
    {
        $period = Period::create('2023-01-01', '2023-01-10');
        $anotherPeriod = Period::create('2023-01-05', '2023-01-18');

        $this->assertFalse($period->has($anotherPeriod));
    }

    public function testPeriodDoesNotContainAnotherPeriodInverted(): void
    {
        $period = Period::create('2023-01-05', '2023-01-18');
        $anotherPeriod = Period::create('2023-01-01', '2023-01-10');

        $this->assertFalse($period->has($anotherPeriod));
    }
}
