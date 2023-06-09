<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL;

use Stoullec\QueryFilter\DQL\DQLTableAlias;
use PHPUnit\Framework\TestCase;

final class DQLTableAliasTest extends TestCase
{

    public function testConvertClassToDQLTableAlias(): void
    {
        $actual = DQLTableAlias::convertDQLClassToDQLTableAlias("Director");
        static::assertSame("director", $actual);
        $actual = DQLTableAlias::convertDQLClassToDQLTableAlias("DirectorType");
        static::assertSame("director_type", $actual);
    }

    public function testConvertTableAliasToClass(): void
    {
        $actual = DQLTableAlias::convertTableAliasToClass("director");
        static::assertSame("Director", $actual);
        $actual = DQLTableAlias::convertTableAliasToClass("director_type");
        static::assertSame("DirectorType", $actual);
    }
}