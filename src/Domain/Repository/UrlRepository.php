<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Url;

interface UrlRepository
{
    public function add(Url $url): Url;
}