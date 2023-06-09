<?php

namespace Stoullec\QueryFilter\DQL\DQLClause;

class DQLClauseFrom
{
    public static function getDQL(string $dqlTable, string $dqlTableAlias): string
    {
        return sprintf("FROM %s %s ", $dqlTable, $dqlTableAlias);
    }
}