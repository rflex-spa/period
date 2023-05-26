<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class GetDaysTest extends TestCase
{
    public function testGetDays(): void
    {
        $period = Period::create('2023-01-01 00:00:00', '2023-01-10 23:59:59');

        $this->assertEquals(10, $period->getDays());
    }

    public function testGetDaysBetweenYears(): void
    {
        $period = Period::create('2022-12-31 23:59:59', '2023-01-02 00:00:00');

        $this->assertEquals(3, $period->getDays());
    }

    public function testGetDaysOneSecondDifference(): void
    {
        $period = Period::create('2022-12-31 23:59:59', '2023-01-01 00:00:00');

        $this->assertEquals(2, $period->getDays());
    }

    public function testGetDaysSameDay(): void
    {
        $period = Period::create('1998-05-13 23:59:58', '1998-05-13 23:59:59');

        $this->assertEquals(1, $period->getDays());
    }

    public function testGetDaysTwoDays(): void
    {
        $period = Period::create('2023-01-31 23:59:59', '2023-02-01 00:00:00');

        $this->assertEquals(2, $period->getDays());
    }

    public function testGetDaysThreeHundredAndSixtySixDays(): void
    {
        $period = Period::create('2001-01-31 12:59:59', '2002-01-31 00:00:01');

        $this->assertEquals(366, $period->getDays());
    }

    public function testGetDaysY2K(): void
    {
        $period = Period::create('1999-12-31 23:59:59', '2000-01-01 00:00:00');

        $this->assertEquals(2, $period->getDays());
    }

    public function testGetListOfDays(): void
    {
        $period = Period::create('2023-01-01 23:59:59', '2023-01-10 23:59:59');
        $days = $period->getListOfDays();

        $this->assertIsArray($days);
        $this->assertEquals(10, count($days));
        $this->assertContains('2023-01-01', $days);
        $this->assertContains('2023-01-02', $days);
        $this->assertContains('2023-01-03', $days);
        $this->assertContains('2023-01-04', $days);
        $this->assertContains('2023-01-05', $days);
        $this->assertContains('2023-01-06', $days);
        $this->assertContains('2023-01-07', $days);
        $this->assertContains('2023-01-08', $days);
        $this->assertContains('2023-01-09', $days);
        $this->assertContains('2023-01-10', $days);
    }

    public function testGetListOfDaysOneDay(): void
    {
        $period = Period::create('2023-01-01 23:59:59', '2023-01-01 23:59:59');
        $days = $period->getListOfDays();

        $this->assertIsArray($days);
        $this->assertEquals(1, count($days));
        $this->assertContains('2023-01-01', $days);
    }

    public function testGetListOfDaysTwoDays(): void
    {
        $period = Period::create('2023-01-31 23:59:59', '2023-02-01 00:00:00');
        $days = $period->getListOfDays();

        $this->assertIsArray($days);
        $this->assertEquals(2, count($days));
        $this->assertContains('2023-01-31', $days);
        $this->assertContains('2023-02-01', $days);
    }

    public function testGetListOfDaysFifteenDays(): void
    {
        $period = Period::create('2023-01-28 23:59:59', '2023-02-11 23:59:59');
        $days = $period->getListOfDays();

        $this->assertIsArray($days);
        $this->assertEquals(15, count($days));
        $this->assertContains('2023-01-28', $days);
        $this->assertContains('2023-01-29', $days);
        $this->assertContains('2023-01-30', $days);
        $this->assertContains('2023-01-31', $days);
        $this->assertContains('2023-02-01', $days);
        $this->assertContains('2023-02-02', $days);
        $this->assertContains('2023-02-03', $days);
        $this->assertContains('2023-02-04', $days);
        $this->assertContains('2023-02-05', $days);
        $this->assertContains('2023-02-06', $days);
        $this->assertContains('2023-02-07', $days);
        $this->assertContains('2023-02-08', $days);
        $this->assertContains('2023-02-09', $days);
        $this->assertContains('2023-02-10', $days);
        $this->assertContains('2023-02-11', $days);
    }

    public function testGetListOfDaysBetweenYears(): void
    {
        $period = Period::create('2006-12-31 23:59:59', '2007-01-01 00:00:00');
        $days = $period->getListOfDays();

        $this->assertIsArray($days);
        $this->assertEquals(2, count($days));
        $this->assertContains('2006-12-31', $days);
        $this->assertContains('2007-01-01', $days);
    }
}
