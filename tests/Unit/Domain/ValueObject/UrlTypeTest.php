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
        $uri = new UrlType(UrlType::TYPE_CUSTOM);
        $this->assertSame($uri->value(), UrlType::TYPE_CUSTOM);
    }
}