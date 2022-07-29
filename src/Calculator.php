<?php

namespace App;

class Calculator
{
    public function __construct(private \Traversable $modifiers)
    {
    }

    public function calc(int $a, int $b, string $modifierName): int
    {
        foreach ($this->modifiers as $modifier) {
            if ($modifierName === $modifier->getName()) {
                return $modifier->modify($a, $b);
            }
        }

        throw new \InvalidArgumentException(sprintf('No modifier "%s"', $modifierName));
    }
}