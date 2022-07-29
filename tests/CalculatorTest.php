<?php

namespace App\Tests;

use App\Additor;
use App\Calculator;
use App\ModifierInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\at;

class CalculatorTest extends TestCase
{
    public function testExceptionIsThrownWhenModifiersAreEmpty(): void
    {
        $calculatorSut = new Calculator(new \ArrayIterator([]));

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('No modifier "+"');

        $calculatorSut->calc(3, 7, '+');
    }

    public function testCorrectModifierIsSelected()
    {
        /** @var ModifierInterface|MockObject $modifierMockPlus */
        $modifierMockPlus = $this->createMock(ModifierInterface::class);
        $modifierMockPlus->method('getName')->willReturn('+');
//        $modifierMockPlus->expects(at(3))->method('getName')->willReturn('+');
        $modifierMockPlus->expects(self::once())->method('modify')->with(3, 7)->willReturn(10);

        $modifierMockMinus = $this->createMock(ModifierInterface::class);
        $modifierMockMinus->method('getName')->willReturn('-');
//        $modifierMockMinus->expects(self::never())->method('modify');
//        $modifierMockMinus->expects(self::exactly())->method('modify');
        $modifierMockMinus->expects(self::once())->method('modify')->with(7, 3)->willReturn(4);
//
        $calculatorSut = new Calculator(new \ArrayIterator([
            $modifierMockMinus, $modifierMockPlus
        ]));

        static::assertSame(10, $calculatorSut->calc(3, 7, '+'));
        static::assertSame(4, $calculatorSut->calc(7, 3, '-'));
    }

    public function testCanGetModifierNames(): void
    {
        $calculatorSut = new Calculator(
            new \ArrayIterator([
                $this->createModifierMock('x'),
                $this->createModifierMock('y')
            ]));

        self::assertSame(['x', 'y'], $calculatorSut->getModifierNames());
    }

    /**
     * @param string $name
     * @return ModifierInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private function createModifierMock(string $name): MockObject
    {
        $mock = $this->createMock(ModifierInterface::class);
        $mock->method('getName')->willReturn($name);

        return $mock;
    }}