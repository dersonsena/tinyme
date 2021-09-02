<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateUrl;

use App\Shared\Domain\DtoBase;

/**
 * @property-read string $url
 * @property-read string $type
 */
final class InputData extends DtoBase
{
    protected function __construct(
        protected string $url,
        protected string $type
    ) {}
}