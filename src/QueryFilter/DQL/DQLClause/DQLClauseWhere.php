<?php

namespace Stoullec\QueryFilter\DQL\DQLClause;

use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatFromFilterOperatorUtil;
use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatFromLogicOperatorUtil;
use Stoullec\QueryFilter\DQL\DQLClause\Util\Validate\ValidateFilterOperator;
use Stoullec\QueryFilter\DQL\DQLTable;
use Stoullec\QueryFilter\DQL\DQLTableAlias;
use Stoullec\QueryFilter\Filter\Validate\ValidateFilterProperty;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;

class DQLClauseWhere
{

    public function __construct(
        private ValidateFilterOperator $validateFilterOperator,
        private ValidateFilterProperty $validateFilterProperty
    ) {
    }
    /**
     * Example: ["firstName[eq]=Laurent", "[and]", "lastName[eq]=TOULLEC"] => 'WHERE director.firstName = \'Laurent\' AND director.lastName = \'TOULLEC\''
     */
    public function getDQL(array $listOfFilter, string $tableAlias): string
    {
        $result = "";
        $isFirstIteration = true;
        foreach ($listOfFilter as $filter) {
            if ($isFirstIteration) {
                $result = "WHERE ";
                $isFirstIteration = false;
            }
            if (DQLFormatFromLogicOperatorUtil::isValueEqualToOneLogicOperator($filter)) {
                $findLogicOperator = DQLFormatFromLogicOperatorUtil::findLogicOperator($filter);
                if (\str_contains($findLogicOperator, 'or')) {
                    $result .= " OR ";

                } else {
                    $result .= " AND ";
                }
            } else {
                $findFilterOperator = DQLFormatFromFilterOperatorUtil::getFilterOperatorWithEqual($filter);
                $explodeByFilterOperator = explode($findFilterOperator, $filter);
                if (count($explodeByFilterOperator) === 1) {
                    $explodeByFilterOperator = explode("=", $filter);
                    if (empty($explodeByFilterOperator)) {
                        $this->validateFilterOperator->throwErrorIfNoFilterOperatorFound($filter);
                    }
                }
                $propertyName = $explodeByFilterOperator[0];
                $value = $explodeByFilterOperator[1];
                if ($this->isFilterOperatorExist($filter, $tableAlias, $propertyName)) {
                    $result .= self::convertFilterToDQL(
                        $tableAlias,
                        $findFilterOperator,
                        $propertyName,
                        $value
                    );
                }
            }
        }
        return $result;
    }

    /**
     * Example: firstName[eq]=Simon => director.first_name = "Simon"
     */
    private static function convertFilterToDQL(
        string $tableAlias,
        string $findFilterOperator,
        string $propertyName,
        string $value
    ): string {
        $result = "";
        if (str_contains($propertyName, ".")) {
            $explodeByPoint = explode(".", $propertyName);
            $tableAlias = DQLTableAlias::convertDQLClassToDQLTableAlias($explodeByPoint[0]);
            $propertyName = $explodeByPoint[1];
        }
        if (
            "[ctn]=" === $findFilterOperator ||
            "[not:ctn]=" === $findFilterOperator
        ) {
            $result = $tableAlias . "." . $propertyName . " LIKE '%" . $value . "%'";
        }
        if (
            "[sw]=" === $findFilterOperator ||
            "[not:sw]=" === $findFilterOperator
        ) {
            $result = $tableAlias . "." . $propertyName . " LIKE '" . $value . "%'";
        }
        if (
            "[ew]=" === $findFilterOperator ||
            "[not:ew]=" === $findFilterOperator
        ) {
            $result = $tableAlias . "." . $propertyName . " LIKE '%" . $value . "'";
        }
        if (
            "[btw]=" === $findFilterOperator ||
            "[not:btw]=" === $findFilterOperator
        ) {
            $explodeValue = explode(",", $value);
            if (count($explodeValue) > 1) {
                $result = $tableAlias . "." . $propertyName . " BETWEEN '" . $explodeValue[0] . "' AND '" . $explodeValue[1] . "'";
            } else {
                $result = $tableAlias . "." . $propertyName . " BETWEEN '0' AND '" . $explodeValue[0] . "'";
            }
        }
        if (
            "[gte]=" === $findFilterOperator ||
            "[not:gte]=" === $findFilterOperator
        ) {
            $result = $tableAlias . "." . $propertyName . ' >= ' . $value;
        }
        if (
            "[gt]=" === $findFilterOperator ||
            "[not:gt]=" === $findFilterOperator
        ) {
            $result = $tableAlias . "." . $propertyName . ' > ' . $value;
        }
        if (
            "[ste]=" === $findFilterOperator ||
            "[not:ste]=" === $findFilterOperator
        ) {
            $result = $tableAlias . "." . $propertyName . ' <= ' . $value;
        }
        if (
            "[st]=" === $findFilterOperator ||
            "[not:st]=" === $findFilterOperator
        ) {
            $result = $tableAlias . "." . $propertyName . ' < ' . $value;
        }
        if (
            "[eq]=" === $findFilterOperator ||
            "[not:eq]=" === $findFilterOperator ||
            "=" === $findFilterOperator
        ) {
            if (\str_contains($value, '"')) {
                $value = \str_replace('"', "", $value);
            }
            if (\str_contains($value, "'")) {
                $value = \str_replace("'", "", $value);
            }
            $result = $tableAlias . "." . $propertyName . " = '" . $value . "'";
        }
        if (
            "[not:ctn]=" === $findFilterOperator ||
            "[not:sw]=" === $findFilterOperator ||
            "[not:ew]=" === $findFilterOperator ||
            "[not:btw]=" === $findFilterOperator ||
            "[not:gte]=" === $findFilterOperator ||
            "[not:gt]=" === $findFilterOperator ||
            "[not:ste]=" === $findFilterOperator ||
            "[not:st]=" === $findFilterOperator ||
            "[not:eq]=" === $findFilterOperator
        ) {
            return sprintf("NOT (%s)", $result);
        }

        return $result;
    }

    /**
     * Example: "firstName[eq]=Marc" => true
     */
    private function isFilterOperatorExist(string $filter, string $tableAlias, string $propertyName): bool
    {
        if (
            \str_contains(
                $filter,
                "[btw]"
            ) ||
            \str_contains(
                $filter,
                "[ctn]"
            ) ||
            \str_contains(
                $filter,
                "[ew]"
            ) ||
            \str_contains(
                $filter,
                "[eq]"
            ) ||
            \str_contains(
                $filter,
                "[gte]"
            ) ||
            \str_contains(
                $filter,
                "[ste]"
            ) ||
            \str_contains(
                $filter,
                "[st]"
            ) ||
            \str_contains(
                $filter,
                "[sort]"
            ) ||
            \str_contains(
                $filter,
                "[not:btw]"
            ) ||
            \str_contains(
                $filter,
                "[not:ctn]"
            ) ||
            \str_contains(
                $filter,
                "[not:ew]"
            ) ||
            \str_contains(
                $filter,
                "[not:eq]"
            ) ||
            \str_contains(
                $filter,
                "[not:gte]"
            ) ||
            \str_contains(
                $filter,
                "[not:gt]"
            ) ||
            \str_contains(
                $filter,
                "[not:ste]"
            ) ||
            \str_contains(
                $filter,
                "[not:sw:]"
            )
        ) {
            return true;
        }

        if (\str_contains($filter, "=")) {
            $dqlTable = sprintf(
                "%s%s",
                DQLTable::PREFIX_FOLDER_ENTITY,
                DQLTableAlias::convertTableAliasToClass($tableAlias)
            );
            $this->validateFilterProperty->throwErrorIfPropertyNotExist($dqlTable, $propertyName, $tableAlias);
            return true;
        }

        return false;
    }
}