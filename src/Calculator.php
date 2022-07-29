<?php

namespace App;

use App\ModifierInterface;

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

    public function getModifierNames(): array
    {
        return array_map(
            function (ModifierInterface $modifier) {
                return $modifier->getName();
            },
            iterator_to_array($this->modifiers)
        );
    }
}