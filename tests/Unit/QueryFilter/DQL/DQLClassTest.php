<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL;

use Stoullec\QueryFilter\DQL\DQLClass;
use PHPUnit\Framework\TestCase;

final class DQLClassTest extends TestCase
{

    public static function testconvertDQLPropertyToDQLClass(): void
    {
        $actual = DQLClass::convertDQLPropertyToDQLClass("person_type");
        static::assertSame("PersonType", $actual);
    }
    public function testGetClass(): void
    {
        $actual = DQLClass::getClass("/director/filter?id=1");
        static::assertSame("Director", $actual);
        $actual = DQLClass::getClass("/director/id498549/filter?id=1");
        static::assertSame("Director", $actual);
        $actual = DQLClass::getClass("/director-type/filter?id=1");
        static::assertSame("DirectorType", $actual);
    }
}