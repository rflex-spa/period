<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class AddDayTest extends TestCase {
    public function testAddDayToTheStart(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->addDay(true, false);

        $expected = Period::create('2023-01-02', '2023-01-10');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testAddDayToTheEnd(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->addDay(false, true);

        $expected = Period::create('2023-01-01', '2023-01-11');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }

    public function testMoveThePeriodOneDayForwards(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $period->addDay(true, true);

        $expected = Period::create('2023-01-02', '2023-01-11');

        $this->assertEquals($expected->getStartDate(), $period->getStartDate());
        $this->assertEquals($expected->getEndDate(), $period->getEndDate());
    }
}
