<?php

namespace Stoullec\QueryFilter\DQL;

class DQLClass
{
    /**
     * Example: "/director-type/filter?id=1 => DirectorType
     */
    public static function getClass(string $urlFilter): string
    {
        $arrayUrlFilterExploded = explode("/", $urlFilter);
        $dqlClassFound = $arrayUrlFilterExploded[1];
        $dqlClass = self::kebabCasToCamelCase($dqlClassFound);

        return $dqlClass;
    }

    /**
     * Example: person_type => PersonType
     */
    public static function convertDQLPropertyToDQLClass(string $dqlProperty): string
    {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $dqlProperty)));

        return $str;
        ;
    }

    private static function kebabCasToCamelCase(string $value): string
    {
        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $value)));

        return $str;
    }

}