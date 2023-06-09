<?php

namespace Stoullec\QueryFilter\DQL\DQLClause;

use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatFromFilterOperatorUtil;
use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatFromLogicOperatorUtil;
use Stoullec\QueryFilter\DQL\DQLProperty;

class DQLClauseInnerJoin
{
    public function __construct(private DQLFormatFromFilterOperatorUtil $dqlFormatFromFilterOperatorUtil)
    {
    }
    /**
     * Example: ['personType.name[eq]=Director'], director => INNER JOIN director.personType person_type
     */
    public function getDQL(array $listOfFilter, string $tableAlias): string
    {
        $result = "";
        foreach ($listOfFilter as $filter) {
            if (
                DQLFormatFromLogicOperatorUtil::isLogicOperatorExist($filter) ||
                str_contains($filter, ".") === false
            ) {
                continue;
            }
            $filterOperator = $this->dqlFormatFromFilterOperatorUtil->findNextFilterOperator($filter);
            $explodeByFilterOperator = explode($filterOperator, $filter);
            $filterProperty = $explodeByFilterOperator[0];
            $explodeFilterByPoint = explode(".", $filterProperty);
            $tmpTableAlias = $tableAlias;
            $tmpResult = "";
            for ($i = 0; $i < count($explodeFilterByPoint) - 1; $i++) {
                $dqlProperty = DQLProperty::convertFilterPropertyToDQLProperty($explodeFilterByPoint[$i]);
                $filterProperty = $explodeFilterByPoint[$i];
                $tmpResult = sprintf(
                    "INNER JOIN %s.%s %s ",
                    $tmpTableAlias,
                    $filterProperty,
                    $dqlProperty
                );
                if (str_contains($result, $tmpResult) === false) {
                    $result .= $tmpResult;
                }
                $tmpTableAlias = $dqlProperty;
            }
        }

        return $result;
    }
}