<?php

namespace Tests\Integration\Domain\UseCase\CreateUrl;

use App\Domain\Contracts\UrlAliasGenerator;
use App\Domain\Entity\Url;
use App\Domain\Repository\UrlRepository;
use App\Domain\UseCase\CreateUrl\CreateUrl;
use App\Domain\UseCase\CreateUrl\InputData;
use Tests\TestCaseBase;

class CreateUrlTest extends TestCaseBase
{
    public function testItShouldGenerateAnUniqueUrlWithRandomAlias()
    {
        $inputData = InputData::create([
            'url' => 'http://www.helloworld.com.br',
            'type' => 'R'
        ]);

        $urlAliasGenerator = new class implements UrlAliasGenerator {
            private string $alias;
            public function generate(int $length = 10): string
            {
                $randomString = sha1(uniqid(rand(), true));
                $this->alias = substr($randomString, 0, $length);
                return $this->alias;
            }

            public function getAlias(): string
            {
                return $this->alias;
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

        $this->assertNotNull($result->id);
        $this->assertSame($result->alias, $urlAliasGenerator->getAlias());
        $this->assertSame($result->originalUrl, $inputData->url);
        $this->assertSame($result->shortenedUrl, sprintf('https://tinyme.cc/%s', $urlAliasGenerator->getAlias()));
    }
}