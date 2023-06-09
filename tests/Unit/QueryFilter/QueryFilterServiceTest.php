<?php

namespace App\Tests\Unit\Service\QueryFilter;

use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseInnerJoin;
use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseWhere;
use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseWhereInnerJoin;
use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatFromFilterOperatorUtil;
use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatUtil;
use Stoullec\QueryFilter\DQL\DQLClause\Util\Validate\ValidateFilterOperator;
use Stoullec\QueryFilter\DQL\DQLTable;
use Stoullec\QueryFilter\Filter\Validate\ValidateFilterProperty;
use Stoullec\QueryFilter\QueryFilterService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

final class QueryFilterServiceTest extends KernelTestCase
{
    private QueryFilterService $queryFilterService;

    protected function setUp(): void
    {
        self::bootKernel();
        $t = self::getContainer()->get(TranslatorInterface::class);
        $validateFilterOperator = new ValidateFilterOperator($t);
        $validateFilterProperty = new ValidateFilterProperty($t);
        $dqlFormatFromFilterOperatorUtil = new DQLFormatFromFilterOperatorUtil($t);
        $dqlClauseWhereInnerJoin = new DQLClauseWhereInnerJoin($dqlFormatFromFilterOperatorUtil);
        $dqlFormatUtil = new DQLFormatUtil(
            $validateFilterOperator,
            $validateFilterProperty,
            $dqlFormatFromFilterOperatorUtil,
            $dqlClauseWhereInnerJoin
        );
        $dqlClauseWhere = new DQLClauseWhere(
            $validateFilterOperator,
            $validateFilterProperty
        );
        $dqlClauseInnerJoin = new DQLClauseInnerJoin($dqlFormatFromFilterOperatorUtil);
        $this->queryFilterService = new QueryFilterService(
            $dqlFormatUtil,
            $dqlClauseWhere,
            $dqlClauseInnerJoin
        );
    }

    public function testFilterWithoutOperator(): void
    {
        $requestMock = $this->createMock(Request::class);
        $requestMock
            ->method('getRequestUri')
            ->willReturn('/director/filter?id[eq]=10')
        ;
        // "/director/filter?id[eq]=1"
        static::assertSame(
            $this->queryFilterService->getQueryDQL($requestMock),
            "SELECT director FROM " . DQLTable::PREFIX_FOLDER_ENTITY . "Director director WHERE director.id = '10'"
        );
    }
}