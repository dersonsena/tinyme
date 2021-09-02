<?php

namespace Domain\UseCase\CreateUrl;

use App\Domain\UseCase\CreateUrl\OutputData;
use DomainException;
use Tests\TestCaseBase;

class OutputDataTest extends TestCaseBase
{
    private array $values = [
        'id' => 'any-id',
        'originalUrl' => 'http://any-original-url',
        'shortenedUrl' => 'https://any-shortened-url',
        'alias' => 'any-alias',
        'createdAt' => '2021-09-02T14:50:30-03:00'
    ];

    public function testItShouldThrowAnExceptionWhenInvalidPropertyIsAssigned()
    {
        $this->expectException(DomainException::class);
        OutputData::create(['invalidProp' => 'any-value']);
    }

    public function testItShouldThrowAnExceptionWhenInvalidPropertyIsRead()
    {
        $this->expectException(DomainException::class);
        $url = OutputData::create($this->values);
        $url->invalidProp;
    }

    public function testItShouldReturnTheRightValuesWhenMagicGetMethodIsCalled()
    {
        $outputData = OutputData::create($this->values);
        $this->assertSame($outputData->id, $this->values['id']);
        $this->assertSame($outputData->originalUrl, $this->values['originalUrl']);
        $this->assertSame($outputData->shortenedUrl, $this->values['shortenedUrl']);
        $this->assertSame($outputData->alias, $this->values['alias']);
    }

    public function testItShouldThrowAnExceptionWhenSomePropertyIsChanged()
    {
        $this->expectException(DomainException::class);
        $outputData = OutputData::create($this->values);
        $outputData->id = 'another-id';
    }
}