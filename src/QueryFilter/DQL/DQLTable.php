<?php

namespace Stoullec\QueryFilter\DQL;

class DQLTable
{
    public const PREFIX_FOLDER_ENTITY = 'App\Entity\\';
    public static function convertDQLClassToDQLTable(string $dqlClass): string
    {
        return sprintf("%s%s", self::PREFIX_FOLDER_ENTITY, $dqlClass);
    }


    /**
     * Example: /director/filter?firstName=Simon => App\Entity\Director
     */
    public static function getFullNameClassFromFilter(string $urlFilter): string
    {
        $dqlClass = DQLClass::getClass($urlFilter);
        return sprintf(
            "%s%s",
            self::PREFIX_FOLDER_ENTITY,
            $dqlClass
        );
    }
}