<?php

declare(strict_types=1);

namespace App\Domain\UseCase\CreateUrl;

final class CreateUrl
{
    public function execute(InputData $inputData): OutputData
    {
        return OutputData::create([
            'id' => 12345,
            'originalUrl' => 'http://www.helloworld.com.br',
            'shortenedUrl' => 'https://tinyme.cc/abcde',
            'pathaaa' => 'abcde'
        ]);
    }
}