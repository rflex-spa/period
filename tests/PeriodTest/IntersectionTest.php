<?php

namespace Tests\PeriodTest;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class IntersectionTest extends TestCase
{
    public function testIntersectionWithAnotherPeriod(): void {
        $period = Period::create('2026-12-03 00:00:00', '2026-12-09 23:59:59');
        $anotherPeriod = Period::create('2026-12-01 00:00:00', '2026-12-05 23:59:59');

        $intersectedPeriod = $period->intersection($anotherPeriod);

        $this->assertEquals('2026-12-03 00:00:00', $intersectedPeriod->getStartDate()->toDateTimeString());
        $this->assertEquals('2026-12-05 23:59:59', $intersectedPeriod->getEndDate()->toDateTimeString());
        $this->assertEquals(259199, $intersectedPeriod->getSeconds());
    }

    public function testIntersectionWithAnotherPeriodWithMinutesAndSeconds(): void {
        $period = Period::create('2025-11-01 05:34:12', '2025-11-09 12:02:53');
        $anotherPeriod = Period::create('2025-11-07 15:13:41', '2025-11-14 23:59:59');

        $intersectedPeriod = $period->intersection($anotherPeriod);

        $this->assertEquals('2025-11-07 15:13:41', $intersectedPeriod->getStartDate()->toDateTimeString());
        $this->assertEquals('2025-11-09 12:02:53', $intersectedPeriod->getEndDate()->toDateTimeString());
        $this->assertEquals(161352, $intersectedPeriod->getSeconds());
    }

    public function testIntersectionWithAnotherPeriodWithMinutesAndSecondsInverted(): void {
        $period = Period::create('2025-11-07 15:13:41', '2025-11-14 23:59:59');
        $anotherPeriod = Period::create('2025-11-01 05:34:12', '2025-11-09 12:02:53');

        $intersectedPeriod = $period->intersection($anotherPeriod);

        $this->assertEquals('2025-11-07 15:13:41', $intersectedPeriod->getStartDate()->toDateTimeString());
        $this->assertEquals('2025-11-09 12:02:53', $intersectedPeriod->getEndDate()->toDateTimeString());
        $this->assertEquals(161352, $intersectedPeriod->getSeconds());
    }

    public function testIntersectionWithPeriodInsideAnother(): void {
        $period = Period::create('2023-02-15 05:00:00', '2023-02-25 23:59:59');
        $anotherPeriod = Period::create('2023-02-17 00:00:00', '2023-02-18 12:00:00');

        $intersectedPeriod = $period->intersection($anotherPeriod);

        $this->assertEquals('2023-02-17 00:00:00', $intersectedPeriod->getStartDate()->toDateTimeString());
        $this->assertEquals('2023-02-18 12:00:00', $intersectedPeriod->getEndDate()->toDateTimeString());
    }

    public function testIntersectionWithPeriodInsideAnotherInverted(): void {
        $period = Period::create('2023-02-17 00:00:00', '2023-02-18 12:00:00');
        $anotherPeriod = Period::create('2023-02-15 05:00:00', '2023-02-25 23:59:59');

        $intersectedPeriod = $period->intersection($anotherPeriod);

        $this->assertEquals('2023-02-17 00:00:00', $intersectedPeriod->getStartDate()->toDateTimeString());
        $this->assertEquals('2023-02-18 12:00:00', $intersectedPeriod->getEndDate()->toDateTimeString());
    }

    public function testIntersectionWithPeriodsWithoutIntersection(): void {
        $period = Period::create('2023-02-17 00:00:00', '2023-02-18 12:00:00');
        $anotherPeriod = Period::create('2023-02-19 12:00:01', '2023-02-20 23:59:59');

        $this->assertNull($period->intersection($anotherPeriod));
    }

    public function testIntersectionWithPeriodsWithoutIntersectionInverted(): void {
        $period = Period::create('2023-02-19 12:00:01', '2023-02-20 23:59:59');
        $anotherPeriod = Period::create('2023-02-17 00:00:00', '2023-02-18 12:00:00');

        $this->assertNull($period->intersection($anotherPeriod));
    }
}
