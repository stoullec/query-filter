<?php

namespace Stoullec\QueryFilter\DQL\DQLClause\Util\Validate;

use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatFromFilterOperatorUtil;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class ValidateFilterOperator
{
    public function __construct(private TranslatorInterface $t)
    {
    }
    public function throwErrorIfNoFilterOperatorFound(string $urlFilter): void
    {
        if (!DQLFormatFromFilterOperatorUtil::isFilterOperatorExist($urlFilter)) {

            throw new BadRequestException(
                $this->t->trans(
                    'bad_request.filter_operator.required',
                    domain: 'StoullecQueryFilterBundle'
                ),
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}