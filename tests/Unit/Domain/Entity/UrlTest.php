<?php

namespace Tests\Unit\Domain\Entity;

use App\Domain\Entity\Url;
use App\Domain\ValueObject\UrlType;
use DateTimeInterface;
use DomainException;
use Tests\TestCaseBase;

final class UrlTest extends TestCaseBase
{
    private array $values = [
        'id' => 'any-id',
        'original' => 'http://any-original-url',
        'shortened' => 'https://any-shortened-url',
        'type' => UrlType::TYPE_RANDOM,
        'alias' => 'any-alias',
        'createdAt' => '2021-09-02T14:50:30-03:00'
    ];

    public function testItShouldThrowAnExceptionWhenInvalidPropertyIsAssigned()
    {
        $this->expectException(DomainException::class);
        Url::create(['invalidProp' => 'any-value']);
    }

    public function testItShouldThrowAnExceptionWhenInvalidPropertyIsRead()
    {
        $this->expectException(DomainException::class);
        $url = Url::create($this->values);
        $url->invalidProp;
    }

    public function testItShouldReturnTheRightValuesWhenGetMethodIsCalled()
    {
        $url = Url::create($this->values);

        $this->assertSame($url->get('id'), $this->values['id']);
        $this->assertSame($url->get('original')->value(), $this->values['original']);
        $this->assertSame($url->get('shortened')->value(), $this->values['shortened']);
        $this->assertSame($url->get('type')->value(), $this->values['type']);
        $this->assertSame($url->get('alias'), $this->values['alias']);
        $this->assertInstanceOf(DateTimeInterface::class, $url->get('createdAt'));
        $this->assertSame($url->get('createdAt')->format(DateTimeInterface::ATOM), $this->values['createdAt']);
    }

    public function testItShouldReturnTheRightValuesWhenMagicGetMethodIsCalled()
    {
        $url = Url::create($this->values);

        $this->assertSame($url->id, $this->values['id']);
        $this->assertSame($url->original->value(), $this->values['original']);
        $this->assertSame($url->shortened->value(), $this->values['shortened']);
        $this->assertSame($url->type->value(), $this->values['type']);
        $this->assertSame($url->alias, $this->values['alias']);
        $this->assertInstanceOf(DateTimeInterface::class, $url->createdAt);
        $this->assertSame($url->createdAt->format(DateTimeInterface::ATOM), $this->values['createdAt']);
    }

    public function testItShouldSetValuesWhenSetMethodIsCalled()
    {
        $url = Url::create($this->values);
        $url->set('id', 'another-id');
        $url->set('original', 'http://another-original-url');
        $url->set('shortened', 'http://another-shortened-url');
        $url->set('type', UrlType::TYPE_CUSTOM);
        $url->set('alias', 'another-alias');
        $url->set('createdAt', '2021-10-02T14:50:30-03:00');

        $this->assertSame($url->id, 'another-id');
        $this->assertSame($url->original->value(), 'http://another-original-url');
        $this->assertSame($url->shortened->value(), 'http://another-shortened-url');
        $this->assertSame($url->type->value(), UrlType::TYPE_CUSTOM);
        $this->assertSame($url->alias, 'another-alias');
        $this->assertInstanceOf(DateTimeInterface::class, $url->createdAt);
        $this->assertSame($url->createdAt->format(DateTimeInterface::ATOM), '2021-10-02T14:50:30-03:00');
    }

    public function testItShouldSetValuesWhenMagicSetMethodIsCalled()
    {
        $url = Url::create($this->values);
        $url->id = 'another-id';
        $url->original = 'http://another-original-url';
        $url->shortened = 'http://another-shortened-url';
        $url->type = UrlType::TYPE_CUSTOM;
        $url->alias = 'another-alias';
        $url->createdAt = '2021-10-02T14:50:30-03:00';

        $this->assertSame($url->id, 'another-id');
        $this->assertSame($url->original->value(), 'http://another-original-url');
        $this->assertSame($url->shortened->value(), 'http://another-shortened-url');
        $this->assertSame($url->type->value(), UrlType::TYPE_CUSTOM);
        $this->assertSame($url->alias, 'another-alias');
        $this->assertInstanceOf(DateTimeInterface::class, $url->createdAt);
        $this->assertSame($url->createdAt->format(DateTimeInterface::ATOM), '2021-10-02T14:50:30-03:00');
    }

    public function testItShouldFillPropertiesWhenFillMethodIsCalled()
    {
        $url = Url::create($this->values);

        $url->fill([
            'id' => 'another-id',
            'original' => 'http://another-original-url',
            'shortened' => 'http://another-shortened-url',
            'type' => UrlType::TYPE_CUSTOM,
            'alias' => 'another-alias',
            'createdAt' => '2021-10-02T14:50:30-03:00'
        ]);

        $this->assertSame($url->id, 'another-id');
        $this->assertSame($url->original->value(), 'http://another-original-url');
        $this->assertSame($url->shortened->value(), 'http://another-shortened-url');
        $this->assertSame($url->type->value(), UrlType::TYPE_CUSTOM);
        $this->assertSame($url->alias, 'another-alias');
        $this->assertInstanceOf(DateTimeInterface::class, $url->createdAt);
        $this->assertSame($url->createdAt->format(DateTimeInterface::ATOM), '2021-10-02T14:50:30-03:00');
    }

    public function testItShouldReturnAllEntityDataAsAssociatedArray()
    {
        $url = Url::create($this->values);
        $urlAsArray = $url->asArray();

        $this->assertArrayHasKey('id', $urlAsArray);
        $this->assertArrayHasKey('original', $urlAsArray);
        $this->assertArrayHasKey('shortened', $urlAsArray);
        $this->assertArrayHasKey('type', $urlAsArray);
        $this->assertArrayHasKey('alias', $urlAsArray);
        $this->assertArrayHasKey('createdAt', $urlAsArray);

        $this->assertSame($urlAsArray['id'], 'any-id');
        $this->assertSame($urlAsArray['original'], 'http://any-original-url');
        $this->assertSame($urlAsArray['shortened'], 'https://any-shortened-url');
        $this->assertSame($urlAsArray['type'], UrlType::TYPE_RANDOM);
        $this->assertSame($urlAsArray['alias'], 'any-alias');
        $this->assertSame($urlAsArray['createdAt'], '2021-09-02T14:50:30-03:00');
    }

    public function testItShouldReturnAllEntityDataAsAssociatedArrayInSnakeCase()
    {
        $url = Url::create($this->values);
        $urlAsArray = $url->asArray(true);

        $this->assertArrayHasKey('created_at', $urlAsArray);
        $this->assertSame($urlAsArray['created_at'], '2021-09-02T14:50:30-03:00');
    }
}