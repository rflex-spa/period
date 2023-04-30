<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class AddDaysTest extends TestCase {
    public function testAddDaysToTheStart(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->addDays(3, true, false);

        $expected = Period::create('2023-01-04', '2023-01-10');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testAddDaysToTheEnd(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->addDays(5, false, true);

        $expected = Period::create('2023-01-01', '2023-01-15');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testMoveThePeriodSixDaysForward(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->addDays(6, true, true);

        $expected = Period::create('2023-01-07', '2023-01-16');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }
}
