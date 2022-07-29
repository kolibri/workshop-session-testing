<?php

namespace App\Calculator\Form;

class CalculatorDto
{
    private int $numberA;
    private string $modifier;
    private int $numberB;

    public function setNumberA(int $numberA): void
    {
        $this->numberA = $numberA;
    }

    public function setModifier(string $modifier): void
    {
        $this->modifier = $modifier;
    }

    public function setNumberB(int $numberB): void
    {
        $this->numberB = $numberB;
    }

    public function getNumberA(): int
    {
        return $this->numberA;
    }

    public function getModifier(): string
    {
        return $this->modifier;
    }

    public function getNumberB(): int
    {
        return $this->numberB;
    }
}