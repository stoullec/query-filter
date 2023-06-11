<?php

namespace Stoullec\QueryFilter\DQL\DQLClause;

use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatFromFilterOperatorUtil;

class DQLClauseWhereInnerJoin
{
    public function __construct(private DQLFormatFromFilterOperatorUtil $dqlFormatFromFilterOperatorUtil)
    {
    }
    /**
     * Example: director.type[eq]=Director => ["director.type = 'Director'"]
     */
    public function getDQL(string $filter): array
    {
        $filterOperator = $this->dqlFormatFromFilterOperatorUtil->findNextFilterOperator($filter);
        if ("[eq]" === $filterOperator && !str_contains($filter, $filterOperator)) {
            $filter = str_replace("=", "[eq]=", $filter);
        }
        $explodeFilterByFilterOperator = explode($filterOperator . "=", $filter);
        $filterProperty = $explodeFilterByFilterOperator[0];
        $filterValue = $explodeFilterByFilterOperator[1];
        $explodeFilterByPoint = explode(".", $filterProperty);
        $filterProperty = sprintf(
            "%s.%s",
            $explodeFilterByPoint[count($explodeFilterByPoint) - 2],
            $explodeFilterByPoint[count($explodeFilterByPoint) - 1]
        );
        $result = sprintf(
            "%s%s=%s",
            $filterProperty,
            $filterOperator,
            $filterValue
        );

        return [$result];
    }

    /**
     * Example: director.type => true
     */
    public static function isFilterPropertyIsInnerJoin(string $filterProperty): bool
    {
        return str_contains($filterProperty, ".");
    }
}