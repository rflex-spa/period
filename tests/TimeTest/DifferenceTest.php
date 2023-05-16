<?php

namespace Tests\TimeTest;

use PHPUnit\Framework\TestCase;
use Rflex\Time;

final class DifferenceTest extends TestCase
{
    public function testDifference(): void
    {
        $time = Time::createFromTimeString('03:00:00');
        $anotherTime = Time::createFromTimeString('12:00:00');

        $differenceInHours = $time->difference($anotherTime);

        echo 'tiempo: '.$differenceInHours.' horas ';

        $this->assertIsInt($differenceInHours);
    }

    public function testDifference2(): void
    {
        $time = Time::createFromTimeString('20:00:00');
        $anotherTime = Time::createFromTimeString('12:00:00');

        $differenceInHours = $time->difference($anotherTime);

        echo 'tiempo: '.$differenceInHours.' horas ';

        $this->assertIsInt($differenceInHours);
    }

    public function testNotEqual(): void
    {
        $time = Time::createFromTimeString('20:00:00');
        $anotherTime = Time::createFromTimeString('12:00:00');

        $differenceInHours = $time->equalTo($anotherTime);

        $this->assertFalse($differenceInHours);
    }

    public function testEqual(): void
    {
        $time = Time::createFromTimeString('20:00:00');
        $anotherTime = Time::createFromTimeString('20:00:00');

        $differenceInHours = $time->equalTo($anotherTime);

        $this->assertTrue($differenceInHours);
    }
}
