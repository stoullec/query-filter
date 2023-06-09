<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL;

use Stoullec\QueryFilter\DQL\DQLTable;
use PHPUnit\Framework\TestCase;

final class DQLTableTest extends TestCase
{

    public function testConvertDQLClassToDQLTable(): void
    {
        $actual = DQLTable::convertDQLClassToDQLTable("Director");
        static::assertSame(DQLTable::PREFIX_FOLDER_ENTITY . "Director", $actual);
    }

    public function testGetFullNameClassFromFilter(): void
    {
        $actual = DQLTable::getFullNameClassFromFilter("/director/filter?firstName=Simon");
        static::assertSame(DQLTable::PREFIX_FOLDER_ENTITY . "Director", $actual);
        $actual = DQLTable::getFullNameClassFromFilter("/director-type/filter?firstName=Simon");
        static::assertSame(DQLTable::PREFIX_FOLDER_ENTITY . "DirectorType", $actual);
        $actual = DQLTable::getFullNameClassFromFilter("/director-type/bonjour/filter?firstName=Simon");
        static::assertSame(DQLTable::PREFIX_FOLDER_ENTITY . "DirectorType", $actual);
    }
}