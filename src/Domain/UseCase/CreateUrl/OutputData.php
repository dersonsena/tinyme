<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateUrl;

use App\Shared\Domain\DtoBase;

/**
 * @property-read string $id
 * @property-read string $originalUrl
 * @property-read string $shortenedUrl
 * @property-read string $alias
 * @property-read string $createdAt
 */
final class OutputData extends DtoBase
{
    protected function __construct(
        protected string|int $id,
        protected string $originalUrl,
        protected string $shortenedUrl,
        protected string $alias,
        protected string $createdAt
    ) {}
}