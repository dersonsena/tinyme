<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateUrl;

use App\Domain\Contracts\UrlAliasGenerator;
use App\Domain\Entity\Url;
use App\Domain\Repository\UrlRepository;
use DateTimeInterface;

final class CreateUrl
{
    public function __construct(
        private UrlAliasGenerator $urlAliasGenerator,
        private UrlRepository $urlRepository
    ) {}

    public function execute(InputData $inputData): OutputData
    {
        $urlAlias = $this->urlAliasGenerator->generate();
        $url = Url::create([
            'original' => $inputData->url,
            'shortened' => sprintf('https://tinyme.cc/%s', $urlAlias),
            'type' => $inputData->type,
            'alias' => $urlAlias,
            'createdAt' => '2021-09-02T14:50:30-03:00'
        ]);

        $url = $this->urlRepository->add($url);

        return OutputData::create([
            'id' => $url->id,
            'originalUrl' => $url->original->value(),
            'shortenedUrl' => $url->shortened->value(),
            'alias' => $url->alias,
            'createdAt' => $url->createdAt->format(DateTimeInterface::ATOM)
        ]);
    }
}