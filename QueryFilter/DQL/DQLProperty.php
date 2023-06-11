<?php

namespace Stoullec\QueryFilter\DQL;

class DQLProperty
{
    public static function convertFilterPropertyToDQLProperty(string $filterProperty): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $filterProperty));
    }
}