<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Rflex\Duration;

final class CreateFromSecondsTest extends TestCase
{
    public function testCreateFromSeconds(): void
    {
        $duration = Duration::createFromSeconds(86211);

        $this->assertEquals(86211, $duration->getSeconds());
    }
}
