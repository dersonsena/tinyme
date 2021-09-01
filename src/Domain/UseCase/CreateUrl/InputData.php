<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateUrl;

use DomainException;

/**
 * @property-read string $url
 * @property-read string $type
 */
final class InputData
{
    private function __construct(
        private string $url,
        private string $type
    ) {}

    public static function create(array $values): self
    {
        foreach ($values as $property => $value) {
            if (!property_exists(InputData::class, $property)) {
                throw new DomainException(sprintf("Invalid property '%s' in DTO class '%s'", $property, get_class()));
            }
        }

        return new self($values['url'], $values['type']);
    }

    public function __get(string $name)
    {
        if (!property_exists($this, $name)) {
            throw new DomainException(sprintf("Invalid property '%s' in DTO class '%s'", $name, get_class()));
        }

        return $this->{$name};
    }

    public function __set(string $name, $value)
    {
        throw new DomainException(
            sprintf("You cannot change the property '%s' of the DTO '%s' because it's read-only.", $name, get_class())
        );
    }
}