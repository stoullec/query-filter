<?php

namespace Stoullec\QueryFilter\DQL\DQLClause\Util;

use function PHPUnit\Framework\stringContains;

class DQLFormatFromLogicOperatorUtil
{
    /**
     * Example: firstName[eq]=Marc[and]lastName[eq]=TOULLEC => [and]
     */
    public static function findNextLogicOperator(string $filter): string
    {
        $result = "";
        if (self::isLogicOperatorExist($filter)) {
            \preg_match("^\[[a-z:]{2,7}\]^", $filter, $result);
            $firstResult = $result[0];
            while (!self::isLogicOperatorExist($firstResult)) {
                $tmpExplode = explode($firstResult, $filter);
                for ($i = 0; $i < count($tmpExplode); $i++) {
                    if (self::isLogicOperatorExist($tmpExplode[$i])) {
                        $result = $tmpExplode[$i];
                        break;
                    }
                }
                if ("" !== $result) {
                    return self::findLogicOperator($result);
                }
            }

            return $firstResult;
        }
        return "";
    }

    /**
     * Example: "firstName[eq]=[or]" => true
     */
    public static function isLogicOperatorIsValue(string $logicOperator, string $filterOperator, string $filter): bool
    {
        $explodeFilter = explode($filterOperator . "=", $filter);

        return $logicOperator === \substr($explodeFilter[1], 0, \strlen($logicOperator));
    }

    /**
     * Example: "firstName[eq]=Marc[or]firstName[eq]=Marc" => true
     */
    public static function isLogicOperatorExist(string $value): bool
    {
        if (
            \str_contains(
                $value,
                "[and]"
            ) ||
            \str_contains(
                $value,
                "[not:and]"
            ) ||
            \str_contains(
                $value,
                "[or]"
            ) ||
            \str_contains(
                $value,
                "[not:or]"
            )
        ) {
            return true;
        }
        return false;
    }


    public static function isValueEqualToOneLogicOperator(string $value): bool
    {
        if (
            "[and]" === $value ||
            "[not:and]" === $value ||
            "[or]" === $value ||
            "[not:or]" === $value
        ) {
            return true;
        }

        return false;
    }

    public static function findLogicOperator(string $filter): string
    {
        if (str_contains($filter, "[and]")) {
            return "[and]";
        } elseif (str_contains($filter, "[not:and]")) {
            return "[not:and]";
        } elseif (str_contains($filter, "[or]")) {
            return "[or]";
        } elseif (str_contains($filter, "[not:or]")) {
            return "[not:or]";
        }
        return "";
    }
}