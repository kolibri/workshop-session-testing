<?php

namespace App\Tests;

use App\Additor;
use PHPUnit\Framework\TestCase;

class AdditorTest extends TestCase
{
    public function testCanAddNumber()
    {
        $additorSut = new Additor();

        self::assertSame(10, $additorSut->modify(3, 7));
    }
}