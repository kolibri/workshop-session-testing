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
        self::assertSame(12, $additorSut->modify(5, 7));
    }

    /** @dataProvider numberProvider */
    public function testCanAddMoreNumbers(int $givenA, int $givenB, int $expectedResult)
    {
        $additorSut = new Additor();

        self::assertSame($expectedResult, $additorSut->modify($givenA, $givenB));
    }

    public function numberProvider(): \Generator
    {
        yield [3, 7, 10];
        yield [5, 2, 7];
    }
}