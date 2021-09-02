<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\Uri;
use App\Domain\ValueObject\UrlType;
use App\Shared\Domain\EntityBase;
use DateTimeImmutable;
use DateTimeInterface;

/**
 * @property string|int|null $id = null
 * @property Uri $original
 * @property Uri $shortened
 * @property UrlType $type
 * @property string $alias
 * @property DateTimeInterface $createdAt
 */
final class Url extends EntityBase
{
    protected Uri $original;
    protected Uri $shortened;
    protected UrlType $type;
    protected string $alias;
    protected DateTimeInterface $createdAt;

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

    public function setCreatedAt(string $date)
    {
        $this->createdAt = new DateTimeImmutable($date);
    }
}