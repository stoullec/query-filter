<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL\DQLClause;

use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseWhereInnerJoin;
use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatFromFilterOperatorUtil;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Contracts\Translation\TranslatorInterface;

final class DQLClauseWhereInnerJoinTest extends KernelTestCase
{
    private DQLClauseWhereInnerJoin $dqlClauseWhereInnerJoin;
    protected function setUp(): void
    {
        self::bootKernel();
        $t = self::getContainer()->get(TranslatorInterface::class);
        $dqlFormatFromFilterOperatorUtil = new DQLFormatFromFilterOperatorUtil($t);
        $this->dqlClauseWhereInnerJoin = new DQLClauseWhereInnerJoin($dqlFormatFromFilterOperatorUtil);
    }
    public function testGetDQL(): void
    {
        $actual = $this->dqlClauseWhereInnerJoin->getDQL("personType.name=Director");
        static::assertSame(["personType.name[eq]=Director"], $actual);
        $actual = $this->dqlClauseWhereInnerJoin->getDQL("personType.name[eq]=Director");
        static::assertSame(["personType.name[eq]=Director"], $actual);
        $actual = $this->dqlClauseWhereInnerJoin->getDQL("personType.type.name=Director");
        static::assertSame(["type.name[eq]=Director"], $actual);
        $actual = $this->dqlClauseWhereInnerJoin->getDQL("personType.type.name[eq]=Director");
        static::assertSame(["type.name[eq]=Director"], $actual);
    }
    public function testIsFilterPropertyIsInnerJoin(): void
    {
        static::assertFalse(DQLClauseWhereInnerJoin::isFilterPropertyIsInnerJoin("firstName"));
        static::assertFalse(DQLClauseWhereInnerJoin::isFilterPropertyIsInnerJoin("firstName"));
        static::assertTrue(DQLClauseWhereInnerJoin::isFilterPropertyIsInnerJoin("personType.name"));
        static::assertTrue(DQLClauseWhereInnerJoin::isFilterPropertyIsInnerJoin("personType.type.name"));
    }
}