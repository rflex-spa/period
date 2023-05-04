<?php

namespace Tests\PeriodTest;

use PHPUnit\Framework\TestCase;
use Rflex\Event;
use Rflex\Period;

final class DifferenceWithEventTest extends TestCase
{
    public function testDifferenceWithEventAtStart(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');
        $event = Event::create('2023-01-01 00:57:35');

        $this->assertEquals(3455, $period->differenceWithEvent($event, 0));
    }

    public function testDifferenceWithEventAtEnd(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');
        $event = Event::create('2023-01-01 00:57:35');

        $this->assertEquals(-860544, $period->differenceWithEvent($event, 1));
    }
}
