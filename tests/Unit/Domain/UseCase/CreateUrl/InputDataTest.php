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
        $inputData = InputData::create($this->values);
        $inputData->invalidProp;
    }

    public function testItShouldReturnTheRightValuesWhenMagicGetMethodIsCalled()
    {
        $inputData = InputData::create($this->values);
        $this->assertSame($inputData->url, $this->values['url']);
        $this->assertSame($inputData->type, $this->values['type']);
    }

    public function testItShouldThrowAnExceptionWhenSomePropertyIsChanged()
    {
        $this->expectException(DomainException::class);
        $inputData = InputData::create($this->values);
        $inputData->url = 'http://another-url';
        $inputData->type = 'C';
    }
}