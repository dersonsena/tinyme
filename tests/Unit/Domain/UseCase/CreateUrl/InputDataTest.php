<?php

namespace Domain\UseCase\CreateUrl;

use App\Domain\UseCase\CreateUrl\InputData;
use DomainException;
use Tests\TestCaseBase;

class InputDataTest extends TestCaseBase
{
    private array $values = [
        'url' => 'http://any-url',
        'type' => 'R',
    ];

    public function testItShouldThrowAnExceptionWhenInvalidPropertyIsAssigned()
    {
        $this->expectException(DomainException::class);
        InputData::create(['invalidProp' => 'any-value']);
    }

    public function testItShouldThrowAnExceptionWhenInvalidPropertyIsRead()
    {
        $this->expectException(DomainException::class);
        $url = InputData::create($this->values);
        $url->invalidProp;
    }

    public function testItShouldReturnTheRightValuesWhenMagicGetMethodIsCalled()
    {
        $url = InputData::create($this->values);
        $this->assertSame($url->url, $this->values['url']);
        $this->assertSame($url->type, $this->values['type']);
    }

    public function testItShouldThrowAnExceptionWhenSomePropertyIsChanged()
    {
        $this->expectException(DomainException::class);
        $url = InputData::create($this->values);
        $url->url = 'http://another-url';
        $url->type = 'C';
    }
}