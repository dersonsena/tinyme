<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateUrl;

use App\Domain\Entity\Url;

final class CreateUrl
{
    public function execute(InputData $inputData): OutputData
    {
        $url = Url::create([
            'original' => $inputData->url,
            'shortened' => 'https://tinyme.cc/xpto',
            'type' => $inputData->type,
            'alias' => 'xpto'
        ]);

        return OutputData::create([
            'id' => 1,
            'originalUrl' => $url->original->value(),
            'shortenedUrl' => $url->shortened->value(),
            'alias' => $url->alias
        ]);
    }
}