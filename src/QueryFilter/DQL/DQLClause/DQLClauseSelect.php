<?php

namespace Stoullec\QueryFilter\DQL\DQLClause;

class DQLClauseSelect
{
    public static function getDQL(string $tableAlias): string
    {
        return sprintf("SELECT %s ", $tableAlias);
    }
}