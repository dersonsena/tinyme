<?php

namespace Domain\ValueObject;

use App\Domain\ValueObject\Uri;
use DomainException;
use Tests\TestCaseBase;

class UriTest extends TestCaseBase
{
    public function testItShouldThrowAnExceptionWhenUrlIsEmpty()
    {
        $this->expectException(DomainException::class);
        new Uri('');
    }

    public function testItShouldThrowAnExceptionWhenInvalidUrlIsProvided()
    {
        $this->expectException(DomainException::class);
        new Uri('invalid-url');
    }

    public function testItShouldReturnTheUrlWhenAValidUrlIsPassed()
    {
        $uri = new Uri('http://valid-url');
        $this->assertSame($uri->value(), 'http://valid-url');
    }
}