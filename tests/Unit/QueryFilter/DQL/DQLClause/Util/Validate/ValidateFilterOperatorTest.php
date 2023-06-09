<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL\DQLClause\Util\Validate;

use Stoullec\QueryFilter\DQL\DQLClause\Util\Validate\ValidateFilterOperator;
use PHPUnit\Framework\MockObject\MockClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ValidateFilterOperatorTest extends KernelTestCase
{
    private DataCollectorTranslator $t;
    private DataCollectorTranslator&MockObject $translatorMock;
    protected function setUp(): void
    {
        self::bootKernel();
        $this->t = self::getContainer()->get(TranslatorInterface::class);
        $this->translatorMock = $this->createMock(DataCollectorTranslator::class);
        $this->translatorMock->method('trans')->willReturn($this->t->trans('bad_request.filter_operator.required', domain: 'StoullecQueryFilterBundle'));
    }
    public function testThrowErrorIfNoFilterOperatorFound(): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage($this->t->trans('bad_request.filter_operator.required', domain: 'StoullecQueryFilterBundle'));
       
        $validatorFilterOperator = new ValidateFilterOperator($this->translatorMock);
        $validatorFilterOperator->throwErrorIfNoFilterOperatorFound("/bonjour/filter?firstName");
    }

}