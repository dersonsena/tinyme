<?php

declare(strict_types=1);

namespace App\Shared\Domain\Contracts;

interface ValueObject
{
    public function value(): mixed;
    public function __toString(): string;
}