<?php

namespace App;

interface ModifierInterface
{
    public function modify(int $a, int $b): int;

    public function getName(): string;
}