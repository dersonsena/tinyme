<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use DomainException;

final class UrlType
{
    private string $value;

    public const TYPE_RANDOM = 'R';
    public const TYPE_CUSTOM = 'C';

    public function __construct(string $value)
    {
        $values = [self::TYPE_RANDOM, self::TYPE_CUSTOM];

        if (empty($value)) {
            throw new DomainException('URL Type cannot be empty');
        }

        if (!in_array($value, $values)) {
            throw new DomainException(sprintf("Invalid URL Type '%s'", $value));
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}