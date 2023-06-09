<?php

namespace Stoullec\QueryFilter;

use Stoullec\QueryFilter\DQL\DQLClass;
use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseFrom;
use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseInnerJoin;
use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseSelect;
use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseWhere;
use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatUtil;
use Stoullec\QueryFilter\DQL\DQLTable;
use Stoullec\QueryFilter\DQL\DQLTableAlias;
use Symfony\Component\HttpFoundation\Request;

class QueryFilterService
{
    public function __construct(
        private DQLFormatUtil $dQLFormatUtil,
        private DQLClauseWhere $dQLClauseWhere,
        private DQLClauseInnerJoin $dqlClauseInnerJoin
    ) {
    }
    /**
     * Example: "SELECT director FROM App\Entity\Director director WHERE director.id = 1"
     */
    public function getQueryDQL(Request $request): string
    {
        $dqlClass = DQLClass::getClass($request->getRequestUri());
        $tableAlias = DQLTableAlias::convertDQLClassToDQLTableAlias($dqlClass);
        $listOfFilter = $this->dQLFormatUtil->getListOfFilterFomUrlFilter($request->getRequestUri(), $tableAlias);
        $result = sprintf(
            "%s%s%s%s",
            DQLClauseSelect::getDQL($tableAlias),
            DQLClauseFrom::getDQL(
                DQLTable::getFullNameClassFromFilter($request->getRequestUri()),
                $tableAlias
            ),
            $this->dqlClauseInnerJoin->getDQL($listOfFilter, $tableAlias),
            $this->dQLClauseWhere->getDQL($listOfFilter, $tableAlias)
        );

        return $result;
    }

}