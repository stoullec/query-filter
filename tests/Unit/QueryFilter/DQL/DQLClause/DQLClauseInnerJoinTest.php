<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL\DQLClause;

use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseInnerJoin;
use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatFromFilterOperatorUtil;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Contracts\Translation\TranslatorInterface;

final class DQLClauseInnerJoinTest extends KernelTestCase
{
    private DQLClauseInnerJoin $dqlClauseInnerJoin;

    protected function setUp(): void
    {
        self::bootKernel();
        $t = self::getContainer()->get(TranslatorInterface::class);
        $dqlFormatFromFilterOperatorUtil = new DQLFormatFromFilterOperatorUtil($t);
        $this->dqlClauseInnerJoin = new DQLClauseInnerJoin($dqlFormatFromFilterOperatorUtil);
    }
    public function testGetDQL(): void
    {
        $actual = $this->dqlClauseInnerJoin->getDQL(['personType[eq]=Director'], 'director');
        static::assertSame("", $actual);
        $actual = $this->dqlClauseInnerJoin->getDQL(['personType.name[eq]=Director'], 'director');
        static::assertSame("INNER JOIN director.personType person_type ", $actual);
        $actual = $this->dqlClauseInnerJoin->getDQL(['personType.name[eq]=Director', '[and]', 'lastName[eq]=TOULLEC'], 'director');
        static::assertSame("INNER JOIN director.personType person_type ", $actual);
        $actual = $this->dqlClauseInnerJoin->getDQL(['personType.type.name[eq]=Director'], 'director');
        static::assertSame("INNER JOIN director.personType person_type INNER JOIN person_type.type type ", $actual);
        $actual = $this->dqlClauseInnerJoin->getDQL(['personType.type.name[eq]=Director', '[and]', 'personType.type.reference[eq]=Reference'], 'director');
        static::assertSame("INNER JOIN director.personType person_type INNER JOIN person_type.type type ", $actual);
    }
}