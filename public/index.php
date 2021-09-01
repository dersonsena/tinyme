<?php

use App\Domain\UseCase\CreateUrl\CreateUrl;
use App\Domain\UseCase\CreateUrl\InputData;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$inputData = InputData::create([
    'url' => 'http://www.helloworld.com.br',
    'type' => 'R'
]);

$createUrl = new CreateUrl();
$result = $createUrl->execute($inputData);

print_r($result);