<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Period;

final class GettersTest extends TestCase
{
    public function testGetSeconds(): void
    {
        $period = Period::create('2023-01-01', '2023-01-10');

        $this->assertEquals(777600, $period->getSeconds());
    }

    public function testGetMinutes(): void
    {
        $period = Period::create('2023-01-01', '2023-01-10');

        $this->assertEquals(12960, $period->getMinutes());
    }

    public function testGetHours(): void
    {
        $period = Period::create('2023-01-01', '2023-01-10');

        $this->assertEquals(216, $period->getHours());
    }
}
