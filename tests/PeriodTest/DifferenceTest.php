<?php

namespace Tests\PeriodTest;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class DifferenceTest extends TestCase
{
    public function testDifference(): void
    {
        $period = Period::create('2023-01-01 03:00:00', '2023-01-10 23:59:59');
        $anotherPeriod = Period::create('2023-01-05 00:00:00', '2023-01-18 12:00:00');

        $difference = $period->difference($anotherPeriod);

        $this->assertIsArray($difference);
        $this->assertArrayHasKey('periods', $difference);
        $this->assertEquals(1, count($difference['periods']));

        $resultPeriod = $difference['periods'][0];

        $this->assertEquals('2023-01-01 03:00:00', $resultPeriod->getStartDate()->toDateTimeString());
        $this->assertEquals('2023-01-04 23:59:59', $resultPeriod->getEndDate()->toDateTimeString());
    }

    public function testDifferenceInverted(): void
    {
        $period = Period::create('2023-01-05 00:00:00', '2023-01-18 12:00:00');
        $anotherPeriod = Period::create('2023-01-01 03:00:00', '2023-01-10 23:59:59');

        $difference = $period->difference($anotherPeriod);

        $this->assertIsArray($difference);
        $this->assertArrayHasKey('periods', $difference);
        $this->assertEquals(1, count($difference['periods']));

        $resultPeriod = $difference['periods'][0];

        $this->assertEquals('2023-01-11 00:00:00', $resultPeriod->getStartDate()->toDateTimeString());
        $this->assertEquals('2023-01-18 12:00:00', $resultPeriod->getEndDate()->toDateTimeString());
    }

    public function testDifferencePeriodContainedInsideAnother(): void
    {
        $period = Period::create('2023-09-10 00:00:00', '2023-09-20 23:59:59');
        $anotherPeriod = Period::create('2023-09-12 09:00:00', '2023-09-17 02:18:31');

        $difference = $period->difference($anotherPeriod);

        $this->assertIsArray($difference);
        $this->assertArrayHasKey('periods', $difference);
        $this->assertEquals(2, count($difference['periods']));

        $firstPeriod = $difference['periods'][0];
        $secondPeriod = $difference['periods'][1];

        $this->assertEquals('2023-09-10 00:00:00', $firstPeriod->getStartDate()->toDateTimeString());
        $this->assertEquals('2023-09-12 08:59:59', $firstPeriod->getEndDate()->toDateTimeString());

        $this->assertEquals('2023-09-17 02:18:32', $secondPeriod->getStartDate()->toDateTimeString());
        $this->assertEquals('2023-09-20 23:59:59', $secondPeriod->getEndDate()->toDateTimeString());
    }

    public function testDifferencePeriodContainedInsideAnotherInverted(): void
    {
        $period = Period::create('2023-09-12 09:00:00', '2023-09-17 02:18:31');
        $anotherPeriod = Period::create('2023-09-10 00:00:00', '2023-09-20 23:59:59');

        $difference = $period->difference($anotherPeriod);

        $this->assertNull($difference);
    }
}
