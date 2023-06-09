<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL\DQLClause;

use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseFrom;
use Stoullec\QueryFilter\DQL\DQLTable;
use PHPUnit\Framework\TestCase;

final class DQLClauseFromTest extends TestCase
{
    public function testGetDQL(): void
    {
        $dqlTable = DQLTable::PREFIX_FOLDER_ENTITY . "Director";
        $dqlTableAlias = "director";
        $actual = DQLClauseFrom::getDQL($dqlTable, $dqlTableAlias);
        static::assertSame("FROM " . DQLTable::PREFIX_FOLDER_ENTITY . "Director director ", $actual);
    }
}