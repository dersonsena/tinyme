<?php

declare(strict_types=1);

namespace App\Shared\Domain\Contracts;

interface Entity
{
    public function getId(): int | string | null;
    public function fill(array $values): void;
    public function set(string $property, mixed $value): Entity;
    public function get(string $property);
    public function asArray(bool $toSnakeCase = false): array;
}