<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\Uri;
use App\Domain\ValueObject\UrlType;
use DomainException;

/**
 * @property string|int|null $id = null
 * @property string $original
 * @property string $shortened
 * @property UrlType $type
 * @property string $alias
 */
final class Url
{
    private string|int|null $id = null;
    private Uri $original;
    private Uri $shortened;
    private UrlType $type;
    private string $alias;

    private function __construct(array $values)
    {
        $this->fill($values);
    }

    public static function create(array $values): self
    {
        return new self($values);
    }

    public function fill(array $values): void
    {
        foreach ($values as $attribute => $value) {
            $this->set($attribute, $value);
        }
    }

    public function set(string $property, $value): self
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

    public function __get(string $property): mixed
    {
        return $this->get($property);
    }

    public function __set(string $property, mixed $value): void
    {
        $this->set($property, $value);
    }

    public function setOriginal(string $url)
    {
        $this->original = new Uri($url);
    }

    public function setShortened(string $url)
    {
        $this->shortened = new Uri($url);
    }

    public function setType(string $type)
    {
        $this->type = new UrlType($type);
    }
}