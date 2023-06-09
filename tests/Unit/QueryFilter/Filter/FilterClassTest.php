<?php

namespace App\Tests\Unit\Service\QueryFilter\Filter;

use Stoullec\QueryFilter\DQL\DQLTable;
use Stoullec\QueryFilter\Filter\FilterClass;
use PHPUnit\Framework\TestCase;

final class FilterClassTest extends TestCase
{
    public function testGetClass(): void
    {
        $actual = FilterClass::getClass("/director/filter?id=1");
        static::assertSame("director", $actual);
        $actual = FilterClass::getClass("/director/id498549/filter?id=1");
        static::assertSame("director", $actual);
        $actual = FilterClass::getClass("/director-type/filter?id=1");
        static::assertSame("director-type", $actual);
        $actual = FilterClass::getClass("/director-type-bonjour/filter?id=1");
        static::assertSame("director-type-bonjour", $actual);
    }
}