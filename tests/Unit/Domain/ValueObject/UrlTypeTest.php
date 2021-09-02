<?php

namespace Domain\ValueObject;

use App\Domain\ValueObject\UrlType;
use DomainException;
use Tests\TestCaseBase;

class UrlTypeTest extends TestCaseBase
{
    public function testItShouldThrowAnExceptionWhenTypeIsEmpty()
    {
        $this->expectException(DomainException::class);
        new UrlType('');
    }

    public function testItShouldThrowAnExceptionWhenInvalidTypeIsProvided()
    {
        $this->expectException(DomainException::class);
        new UrlType('invalid-type');
    }

    public function testItShouldReturnTheTypeWhenAValidTypeIsPassed()
    {
        $type = new UrlType(UrlType::TYPE_CUSTOM);
        $this->assertSame($type->value(), UrlType::TYPE_CUSTOM);
    }

    public function testItShouldReturnTheUrlWhenTheObjectIsConvertedToString()
    {
        $type = new UrlType(UrlType::TYPE_CUSTOM);
        $this->assertSame((string)$type, UrlType::TYPE_CUSTOM);
    }
}