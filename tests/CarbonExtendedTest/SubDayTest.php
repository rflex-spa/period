<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class SubDayTest extends TestCase {
    public function testSubDayToTheStart(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->subDay(true, false);

        $expected = Period::create('2022-12-31', '2023-01-10');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testSubDayToTheEnd(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->subDay(false, true);

        $expected = Period::create('2023-01-01', '2023-01-09');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testMoveThePeriodOneDayBackwards(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->subDay(true, true);

        $expected = Period::create('2022-12-31', '2023-01-09');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }
}
