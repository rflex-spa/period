<?php

namespace Tests\TimeTest;

use PHPUnit\Framework\TestCase;
use Rflex\Time;

final class DifferenceTest extends TestCase
{
    public function testDifferenceFirstTimeLessThanSecond(): void
    {
        $time = Time::createFromTimeString('03:00:01');
        $anotherTime = Time::createFromTimeString('12:00:00');

        $difference = $time->difference($anotherTime);

        $this->assertEquals('08:59:59', $difference->format('H:i:s'));
        $this->assertEquals(32399, $difference->getSeconds());
    }

    public function testDifferenceFirstTimeGreaterThanSecond(): void
    {
        $time = Time::createFromTimeString('20:00:00');
        $anotherTime = Time::createFromTimeString('12:00:00');

        $difference = $time->difference($anotherTime);

        $this->assertEquals('16:00:00', $difference->format('H:i:s'));
        $this->assertEquals(57600, $difference->getSeconds());
    }

    public function testDifferenceFirstTimeGreaterThanSecond2(): void
    {
        $time = Time::createFromTimeString('14:24:11');
        $anotherTime = Time::createFromTimeString('12:00:00');

        $difference = $time->difference($anotherTime);

        $this->assertEquals('21:35:49', $difference->format('H:i:s'));
        $this->assertEquals(77749, $difference->getSeconds());
    }

    public function testEqual(): void
    {
        $time = Time::createFromTimeString('20:00:00');
        $anotherTime = Time::createFromTimeString('20:00:00');

        $difference = $time->difference($anotherTime);

        $this->assertEquals('00:00:00', $difference->format('H:i:s'));
        $this->assertEquals(0, $difference->getSeconds());
    }
}
