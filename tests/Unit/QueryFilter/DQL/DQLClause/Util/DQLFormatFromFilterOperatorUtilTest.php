<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL\DQLClause\Util;

use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatFromFilterOperatorUtil;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Contracts\Translation\TranslatorInterface;

final class DQLFormatFromFilterOperatorUtilTest extends KernelTestCase
{
    private DQLFormatFromFilterOperatorUtil $dqlFormatFromFilterOperatorUtil;

    protected function setUp(): void
    {
        self::bootKernel();
        $t = self::getContainer()->get(TranslatorInterface::class);
        $this->dqlFormatFromFilterOperatorUtil = new DQLFormatFromFilterOperatorUtil($t);
    }

    public function testFindFilterLogicOperator(): void
    {
        $actual = DQLFormatFromFilterOperatorUtil::getFilterOperatorWithEqual("firstName[eq]=Marc");
        static::assertSame("[eq]=", $actual);
        $actual = DQLFormatFromFilterOperatorUtil::getFilterOperatorWithEqual("firstName[ctn]=Marc");
        static::assertSame("[ctn]=", $actual);
        $actual = DQLFormatFromFilterOperatorUtil::getFilterOperatorWithEqual("firstName[bonjour]=Marc");
        static::assertSame("[bonjour]=", $actual);
        $actual = DQLFormatFromFilterOperatorUtil::getFilterOperatorWithEqual("id=1");
        static::assertSame("[eq]=", $actual);
    }
    public function testFindFilerLogicOperator(): void
    {
        $actual = DQLFormatFromFilterOperatorUtil::getFilterOperatorWithEqual("firstName[eq]=Marc");
        static::assertSame("[eq]=", $actual);
    }

    public function testFindNextFilterOperator(): void
    {
        $actual = $this->dqlFormatFromFilterOperatorUtil->findNextFilterOperator("firstName=Marc");
        static::assertSame("[eq]", $actual);
        $actual = $this->dqlFormatFromFilterOperatorUtil->findNextFilterOperator("[and]id[eq]=MAHE");
        static::assertSame("[eq]", $actual);
        $actual = $this->dqlFormatFromFilterOperatorUtil->findNextFilterOperator("firstName[eq]=Marc[and]lastName[eq]=MAHE");
        static::assertSame("[eq]", $actual);
        $actual = $this->dqlFormatFromFilterOperatorUtil->findNextFilterOperator("firstName[eq]=Marc");
        static::assertSame("[eq]", $actual);
        $actual = $this->dqlFormatFromFilterOperatorUtil->findNextFilterOperator("[eq]");
        static::assertSame("[eq]", $actual);
    }

    public function testThrowErrorWhenNoFilterOperator(): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage("At least one filter operator([eq], [btw], etc...) is required.");
        $this->dqlFormatFromFilterOperatorUtil->findNextFilterOperator("[bonjour]");
    }

    public function testGetFilterOperator(): void
    {
        $actual = DQLFormatFromFilterOperatorUtil::getFilterOperator("firstName[eq]=Marc");
        static::assertSame("[eq]", $actual);
    }

    public function testGetFilterOperatorWithEqual(): void
    {
        $actual = DQLFormatFromFilterOperatorUtil::getFilterOperatorWithEqual("firstName[eq]=Marc");
        static::assertSame("[eq]=", $actual);
    }

}