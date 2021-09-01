<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

interface UrlAliasGenerator
{
    public function generate(int $length = 10): string;
    public function getAlias(): string;
}