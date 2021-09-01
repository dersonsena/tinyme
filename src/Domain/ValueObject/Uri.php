<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use DomainException;

final class Uri
{
    private string $uri;

    public function __construct(string $uri)
    {
        if (empty($uri)) {
            throw new DomainException('URI is empty.');
        }

        if (!filter_var($uri, FILTER_VALIDATE_URL)) {
            throw new DomainException(sprintf("Invalid URI '%s'.", $uri));
        }

        $this->uri = $uri;
    }

    public function value(): string
    {
        return $this->uri;
    }
}