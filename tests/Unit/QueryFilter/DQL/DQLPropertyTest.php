<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL;

use Stoullec\QueryFilter\DQL\DQLProperty;
use PHPUnit\Framework\TestCase;

final class DQLPropertyTest extends TestCase
{
    public function testConvertFilterPropertyToDQLProperty(): void
    {
        $actual = DQLProperty::convertFilterPropertyToDQLProperty("id");
        static::assertSame("id", $actual);
        $actual = DQLProperty::convertFilterPropertyToDQLProperty("lastName");
        static::assertSame("last_name", $actual);
    }
}