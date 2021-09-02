<?php

declare(strict_types=1);

namespace App\Shared\Domain;

use DomainException;

abstract class DtoBase
{
    public static function create(array $values): static
    {
        foreach ($values as $property => $value) {
            if (!property_exists(get_called_class(), $property)) {
                throw new DomainException(sprintf("Invalid property '%s' in DTO class '%s'", $property, get_called_class()));
            }
        }

        return new static(...array_values($values));
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