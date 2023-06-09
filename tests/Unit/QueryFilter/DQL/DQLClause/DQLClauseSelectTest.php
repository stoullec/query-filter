<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL\DQLClause;

use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseSelect;
use PHPUnit\Framework\TestCase;

final class DQLClauseSelectTest extends TestCase
{
    public function testGetDQL(): void
    {
        $actual = DQLClauseSelect::getDQL("director");
        static::assertSame($actual, "SELECT director ");
    }
}