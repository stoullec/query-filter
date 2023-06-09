<?php

namespace Stoullec\QueryFilter\Filter\Validate;

use Stoullec\QueryFilter\DQL\DQLClass;
use Stoullec\QueryFilter\DQL\DQLProperty;
use Stoullec\QueryFilter\DQL\DQLTable;
use Stoullec\QueryFilter\DQL\DQLTableAlias;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class ValidateFilterProperty
{
    public function __construct(private TranslatorInterface $t)
    {
    }

    public function throwErrorIfPropertyNotExist(string $dqlTable, string $propertyName, string $tableAlias): void
    {
        if (str_contains($propertyName, ".")) {
            $explodeByPoint = explode(".", $propertyName);

            for ($i = 0; $i < count($explodeByPoint) - 1; $i++) {
                $dqlClass = DQLClass::convertDQLPropertyToDQLClass($explodeByPoint[$i]);
                $dqlTable = DQLTable::convertDQLClassToDQLTable($dqlClass);
                $propertyName = $explodeByPoint[$i + 1];
                $tableAlias = DQLTableAlias::convertDQLClassToDQLTableAlias($dqlClass);
                if (!property_exists($dqlTable, $propertyName)) {
                    throw new BadRequestException(
                        '[' . $explodeByPoint[$i + 1] . '] ' . $this->t->trans(
                            'bad_request.property.not_exist',
                            domain: 'StoullecQueryFilterBundle'
                        ) . ' ' . $tableAlias . '.',
                        Response::HTTP_BAD_REQUEST
                    );
                }
            }
        } else {
            if (!property_exists($dqlTable, $propertyName)) {
                throw new BadRequestException(
                    '[' . $propertyName . '] This property not exist in ' . $tableAlias,
                    Response::HTTP_BAD_REQUEST
                );
            }
        }
    }
}