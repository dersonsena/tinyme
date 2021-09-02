<?php

declare(strict_types=1);

namespace App\Shared\Domain;

use App\Shared\Domain\Contracts\Entity;
use App\Shared\Domain\Contracts\ValueObject;
use DateTimeInterface;
use DomainException;

abstract class EntityBase implements Entity
{
    protected string|int|null $id = null;

    private function __construct(array $values)
    {
        $this->fill($values);
    }

    public static function create(array $values): static
    {
        return new static($values);
    }

    public function getId(): int|string|null
    {
        return $this->id;
    }

    public function fill(array $values): void
    {
        foreach ($values as $attribute => $value) {
            $this->set($attribute, $value);
        }
    }

    public function set(string $property, mixed $value): self
    {
        if (!property_exists($this, $property)) {
            throw new DomainException(sprintf("Invalid property '%s' in Entity class '%s'", $property, get_class()));
        }

        $setter = 'set' . str_replace('_', '', ucwords($property, '_'));

        if (method_exists($this, $setter)) {
            $this->{$setter}($value);
            return $this;
        }

        $this->{$property} = $value;
        return $this;
    }

    public function get(string $property)
    {
        $getter = "get" . ucfirst($property);

        if (method_exists($this, $getter)) {
            return $this->{$getter}();
        }

        if (!property_exists($this, $property)) {
            throw new DomainException(sprintf("Invalid property '%s' in Entity class '%s'", $property, get_class()));
        }

        return $this->{$property};
    }

    public function asArray(bool $toSnakeCase = false): array
    {
        $props = [];
        $propertyList = get_object_vars($this);

        foreach ($propertyList as $name => $value) {
            if ($toSnakeCase) {
                $name = mb_strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));
            }

            if ($value instanceof Entity) {
                $value = $value->asArray($toSnakeCase);
            }

            if ($value instanceof ValueObject) {
                $value = $value->value();
            }

            if ($value instanceof DateTimeInterface) {
                $value = $value->format(DateTimeInterface::ATOM);
            }

            $props[$name] = $value;
        }

        return $props;
    }

    final public function __get(string $property): mixed
    {
        return $this->get($property);
    }

    final public function __set(string $property, mixed $value): void
    {
        $this->set($property, $value);
    }
}