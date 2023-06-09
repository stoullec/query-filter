<?php

namespace Stoullec\QueryFilter\DQL\DQLClause\Util;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Contracts\Translation\TranslatorInterface;

class DQLFormatFromFilterOperatorUtil
{

    public function __construct(private TranslatorInterface $t)
    {
    }
    /**
     * Example: "firstName[eq]=Marc" => "[eq]"
     */
    public static function getFilterOperator(string $filter): string
    {
        $result = "";
        \preg_match("^\[[a-z:]{2,7}\]^", $filter, $result);
        if (empty($result)) {
            return "[eq]=";
        }
        return $result[0];
    }

    /**
     * Example: "firstName[eq]=Marc" => "[eq]="
     */
    public static function getFilterOperatorWithEqual(string $filter): string
    {
        $result = "";
        \preg_match("^\[[a-z:]{2,7}\]^", $filter, $result);
        if (empty($result)) {
            return "[eq]=";
        }
        return $result[0] . '=';
    }

    /**
     * Example: firstName[eq]=Marc[and]lastName[eq]=MAHE => [eq]
     */
    public function findNextFilterOperator(string $filter): string
    {
        $result = "";
        if (self::isFilterOperatorExist($filter)) {
            \preg_match("^\[[a-z:]{2,7}\]^", $filter, $result);
            $firstResult = $result[0];
            while (!self::isFilterOperatorExist($firstResult)) {
                $tmpExplode = explode($firstResult, $filter);
                for ($i = 0; $i < count($tmpExplode); $i++) {
                    if (self::isFilterOperatorExist($tmpExplode[$i])) {
                        $result = $tmpExplode[$i];
                        break;
                    }
                }
                if ("" !== $result) {
                    return DQLFormatFromFilterOperatorUtil::getFilterOperator($result);
                }
            }

            return $firstResult;
        }
        if (str_contains($filter, "=")) {
            return "[eq]";
        }
        throw new BadRequestException(
            $this->t->trans(
                'bad_request.filter_operator.required',
                domain: 'StoullecQueryFilterBundle'
            )
        );
    }

    /**
     * Example: "firstName[eq]=Marc" => true
     */
    public static function isFilterOperatorExist(string $filter): bool
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
                "[gt]"
            ) ||
            \str_contains(
                $filter,
                "[gte]"
            ) ||
            \str_contains(
                $filter,
                "[st]"
            ) ||
            \str_contains(
                $filter,
                "[ste]"
            ) ||
            \str_contains(
                $filter,
                "[sw]"
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
                "[not:st]"
            ) ||
            \str_contains(
                $filter,
                "[not:ste]"
            ) ||
            \str_contains(
                $filter,
                "[not:sw]"
            )
        ) {
            return true;
        }

        return false;
    }
}