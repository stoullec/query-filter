<?php

namespace Stoullec\QueryFilter\Filter;

class FilterClass
{

    /**
     * Example: "/director-type/filter?id=1 => director-type
     */
    public static function getClass(string $urlFilter): string
    {
        $arrayUrlFilterExploded = explode("/", $urlFilter);

        return lcfirst($arrayUrlFilterExploded[1]);
    }
}