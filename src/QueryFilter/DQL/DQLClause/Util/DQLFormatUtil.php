<?php

namespace Stoullec\QueryFilter\DQL\DQLClause\Util;

use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseWhereInnerJoin;
use Stoullec\QueryFilter\DQL\DQLClause\Util\Validate\ValidateFilterOperator;
use Stoullec\QueryFilter\DQL\DQLTable;
use Stoullec\QueryFilter\Filter\Validate\ValidateFilterProperty;

class DQLFormatUtil
{
    public function __construct(
        private ValidateFilterOperator $validateFilterOperator,
        private ValidateFilterProperty $validateFilterProperty,
        private DQLFormatFromFilterOperatorUtil $dQLFormatFromFilterOperatorUtil,
        private DQLClauseWhereInnerJoin $dQLClauseWhereInnerJoin
    ) {
    }
    /**
     * Example: /director/filter?firstName[eq]=Marc[and]lastName[eq]=TOULLEC => ["firstName[eq]=Marc", "[and]", "lastName[eq]=TOULLEC"]
     */
    public function getListOfFilterFomUrlFilter(string $urlFilter, string $tableAlias): array
    {
        $explodeUrlFilter = explode("/filter?", $urlFilter);
        $nextExplodeUrlFilter = "";
        $result = [];
        $filter = $explodeUrlFilter[1];
        $dqlTable = "";
        if (
            \str_contains($filter, "=") &&
            !DQLFormatFromFilterOperatorUtil::isFilterOperatorExist($urlFilter) &&
            !DQLFormatFromLogicOperatorUtil::isLogicOperatorExist($urlFilter)
        ) {
            return self::executeWhenUrlFilterWithoutFilterOperatorAndLogicOperator(
                $filter,
                $urlFilter,
                $tableAlias
            );
        }

        if (
            DQLFormatFromFilterOperatorUtil::isFilterOperatorExist($urlFilter) &&
            !DQLFormatFromLogicOperatorUtil::isLogicOperatorExist($urlFilter)
        ) {
            return self::executeWhenIsFilterOperatorAndWithoutLogicOperator(
                $filter,
                $urlFilter,
                $tableAlias
            );
        }
        $this->validateFilterOperator->throwErrorIfNoFilterOperatorFound($urlFilter);
        $findNextFilterOperator = "";
        if (
            DQLFormatFromFilterOperatorUtil::isFilterOperatorExist($urlFilter) ||
            DQLFormatFromLogicOperatorUtil::isLogicOperatorExist($urlFilter)
        ) {
            $findNextFilterOperator = $this->dQLFormatFromFilterOperatorUtil->findNextFilterOperator($filter);
            $explodeByFilterOperator = explode($findNextFilterOperator . "=", $filter);
            $explodeByFilterOperator = explode(
                $findNextFilterOperator,
                sprintf(
                    "%s%s=%s",
                    $explodeByFilterOperator[0],
                    $findNextFilterOperator,
                    $explodeByFilterOperator[1]
                )
            );
            $nextExplodeUrlFilter = $explodeUrlFilter[1];
            $dqlTable = DQLTable::getFullNameClassFromFilter($urlFilter);
            $findNextLogicOperator = DQLFormatFromLogicOperatorUtil::findNextLogicOperator($nextExplodeUrlFilter);

            while (DQLFormatFromLogicOperatorUtil::isLogicOperatorExist($nextExplodeUrlFilter)) {
                $explodeByLogicOperator = explode($findNextLogicOperator, $nextExplodeUrlFilter);
                $explodeByLogicOperator = self::cleanExplodeByLogicOperatorEmptyValue(
                    $explodeByLogicOperator,
                    $findNextLogicOperator
                );
                if (count($explodeByLogicOperator) > 2) {
                    $nextExplodeUrlFilter = self::strUrlFilterLessCurrentResult($result, $filter);
                }
                $filterProperty = explode($findNextFilterOperator, $nextExplodeUrlFilter)[0];
                $this->validateFilterProperty->throwErrorIfPropertyNotExist($dqlTable, $filterProperty, $tableAlias);

                $result[] = $explodeByLogicOperator[0];
                if ("" !== $findNextLogicOperator) {
                    $result[] = $findNextLogicOperator;
                }
                $nextExplodeUrlFilter = self::strUrlFilterLessCurrentResult($result, $filter);
                $findNextLogicOperator = DQLFormatFromLogicOperatorUtil::findNextLogicOperator($nextExplodeUrlFilter);
                if ("" !== $nextExplodeUrlFilter) {
                    $findNextFilterOperator = $this->dQLFormatFromFilterOperatorUtil->findNextFilterOperator($nextExplodeUrlFilter);
                }
            }
        }
        if (
            DQLFormatFromFilterOperatorUtil::isFilterOperatorExist($nextExplodeUrlFilter) &&
            !DQLFormatFromLogicOperatorUtil::isLogicOperatorExist($nextExplodeUrlFilter)
        ) {
            $filterProperty = explode($findNextFilterOperator, $nextExplodeUrlFilter)[0];
            $this->validateFilterProperty->throwErrorIfPropertyNotExist($dqlTable, $filterProperty, $tableAlias);
            $result[] = $nextExplodeUrlFilter;
        }

        return $result;
    }

    private function executeWhenUrlFilterWithoutFilterOperatorAndLogicOperator(
        string $filter,
        string $urlFilter,
        string $tableAlias
    ): array {
        $explodeByEqual = explode("=", $filter);
        $filterProperty = $explodeByEqual[0];
        if (DQLClauseWhereInnerJoin::isFilterPropertyIsInnerJoin($filterProperty)) {
            return $this->dQLClauseWhereInnerJoin->getDQL($filter);
        } else {
            $dqlTable = DQLTable::getFullNameClassFromFilter($urlFilter);
            $this->validateFilterProperty->throwErrorIfPropertyNotExist($dqlTable, $filterProperty, $tableAlias);
            $value = $explodeByEqual[1];
            return [
                sprintf(
                    "%s[eq]=%s",
                    $filterProperty,
                    $value
                )
            ];
        }
    }

    private function executeWhenIsFilterOperatorAndWithoutLogicOperator(
        string $filter,
        string $urlFilter,
        string $tableAlias
    ): array {
        $findFilterOperator = $this->dQLFormatFromFilterOperatorUtil->findNextFilterOperator($filter);
        $explodeByFilterOperator = explode($findFilterOperator . "=", $filter);
        $filterProperty = $explodeByFilterOperator[0];
        $dqlTable = DQLTable::getFullNameClassFromFilter($urlFilter);
        $this->validateFilterProperty->throwErrorIfPropertyNotExist($dqlTable, $filterProperty, $tableAlias);

        $value = $explodeByFilterOperator[1];
        $result = [
            sprintf(
                "%s%s=%s",
                $filterProperty,
                $findFilterOperator,
                $value
            )
        ];
        return $result;
    }


    private static function strUrlFilterLessCurrentResult(array $result, string $explodeUrlFilter): string
    {
        $strResultReconstituated = "";

        for ($i = 0; $i < count($result); $i++) {
            $strResultReconstituated = sprintf(
                "%s%s",
                $strResultReconstituated,
                $result[$i]
            );
        }
        $nextExplodeUrlFilter = str_replace($strResultReconstituated, "", $explodeUrlFilter);

        return $nextExplodeUrlFilter;
    }

    /**
     * Example [''] => ['[and]']
     */
    private static function cleanExplodeByLogicOperatorEmptyValue(array $explodeByLogicOperator, string $findNextLogicOperator): array
    {
        foreach ($explodeByLogicOperator as $i => $value) {
            if ($value === "")
                $explodeByLogicOperator[$i] = $findNextLogicOperator;
        }

        return $explodeByLogicOperator;
    }
}