<?php

namespace App\Tests\Unit\Service\QueryFilter\Filter\Validate;

use Stoullec\QueryFilter\Filter\Validate\ValidateFilterProperty;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ValidateFilterPropertyTest extends KernelTestCase
{
    private DataCollectorTranslator $t;
    private DataCollectorTranslator&MockObject $translatorMock;
    protected function setUp(): void
    {
        self::bootKernel();
        $this->t = self::getContainer()->get(TranslatorInterface::class);
        $this->translatorMock = $this->createMock(DataCollectorTranslator::class);
        $this->translatorMock->method('trans')->willReturn($this->t->trans('bad_request.property.not_exist', domain: 'StoullecQueryFilterBundle'));
    }
    
    public function testThrowErrorIfPropertyNotExist(): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage("[bonjour] This property not exist in director");

        $validateFilterProperty = new ValidateFilterProperty($this->translatorMock);
        $validateFilterProperty->throwErrorIfPropertyNotExist("director", "bonjour", "director");
    }

    public function testThrowErrorIfPropertyObjectNotExist(): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage("[bonjour] The property does not exists in director.");

        $validateFilterProperty = new ValidateFilterProperty($this->translatorMock);
        $validateFilterProperty->throwErrorIfPropertyNotExist("director", "director.bonjour", "director");
    }

    public function testThrowErrorIfPropertyObjectObjectNotExist(): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage("[bonjour] The property does not exists in person_type.");

        $validateFilterProperty = new ValidateFilterProperty($this->translatorMock);
        $validateFilterProperty->throwErrorIfPropertyNotExist("director", "director.personType.bonjour", "director");
    }
}