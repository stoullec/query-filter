<?php

namespace Stoullec\QueryFilter\DQL;

class DQLTableAlias
{
    /**
     * Example: DirectorType => director_type
     */
    public static function convertDQLClassToDQLTableAlias(string $dqlClass): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $dqlClass));
    }

    /**
     * Example: director_type => DirectorType
     */
    public static function convertTableAliasToClass(string $tableAlias): string
    {
        return ucfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $tableAlias))));
        ;
    }
}