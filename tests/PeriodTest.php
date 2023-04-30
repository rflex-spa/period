<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Period;
use Rflex\Event;

final class PeriodTest extends TestCase {
    public function testPeriodContainsAnotherPeriod(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $anotherPeriod = Period::create('2023-01-05', '2023-01-07');

        $this->assertTrue($period->has($anotherPeriod));
    }

    public function testPeriodDoesNotContainAnotherPeriod(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $anotherPeriod = Period::create('2023-01-05', '2023-01-18');

        $this->assertFalse($period->has($anotherPeriod));
    }
    
    public function testDifferenceWithEventAtStart(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $event = Event::create('2023-01-01 00:57:35');

        $this->assertEquals(3455, $period->differenceWithEvent($event, 0));
    }

    public function testDifferenceWithEventAtEnd(): void {
        $period = Period::create('2023-01-01', '2023-01-10');
        $event = Event::create('2023-01-01 00:57:35');

        $this->assertEquals(-774145, $period->differenceWithEvent($event, 1));
    }
}
