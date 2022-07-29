<?php

namespace App;

class Additor implements ModifierInterface
{
    public function modify(int $a, int $b): int
    {
        return $a + $b;
    }

    public function getName(): string
    {
        return '+';
    }
}
