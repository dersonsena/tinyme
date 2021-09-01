<?php

use App\Domain\Contracts\UrlAliasGenerator;
use App\Domain\Entity\Url;
use App\Domain\Repository\UrlRepository;
use App\Domain\UseCase\CreateUrl\CreateUrl;
use App\Domain\UseCase\CreateUrl\InputData;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$inputData = InputData::create([
    'url' => 'http://www.helloworld.com.br',
    'type' => 'R'
]);

$urlAliasGenerator = new class implements UrlAliasGenerator {
    public function generate(int $length = 10): string
    {
        $randomString = sha1(uniqid(rand(), true));
        return substr($randomString, 0, $length);
    }
};

$urlRepository = new class implements UrlRepository {
    public function add(Url $url): Url
    {
        $url->set('id', rand(1, 9999));
        return $url;
    }
};

$createUrl = new CreateUrl($urlAliasGenerator, $urlRepository);
$result = $createUrl->execute($inputData);

print_r($result);