<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL\DQLClause\Util;

use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatFromLogicOperatorUtil;
use PHPUnit\Framework\TestCase;

final class DQLFormatFromLogicOperatorUtilTest extends TestCase
{
    public function testIsLogicOperatorIsValue(): void
    {
        $actual = DQLFormatFromLogicOperatorUtil::isLogicOperatorIsValue("[or]", "[eq]", "lastName[eq]=[or][or]lastName[eq]=MAHE");
        static::assertTrue($actual);
        $actual = DQLFormatFromLogicOperatorUtil::isLogicOperatorIsValue("[or]", "[eq]", "lastName[eq]=[or][orlastName[eq]=MAHE");
        static::assertTrue($actual);
        $actual = DQLFormatFromLogicOperatorUtil::isLogicOperatorIsValue("[or]", "[ctn]", "lastName[ctn]=[or][or]lastName[eq]=MAHE");
        static::assertTrue($actual);
        $actual = DQLFormatFromLogicOperatorUtil::isLogicOperatorIsValue("[or]", "[eq]", "lastName[eq]=[or[or]lastName[eq]=MAHE");
        static::assertFalse($actual);
        $actual = DQLFormatFromLogicOperatorUtil::isLogicOperatorIsValue("[or]", "[eq]", "lastName[eq]=bonjour[or]lastName[eq]=MAHE");
        static::assertFalse($actual);
        $actual = DQLFormatFromLogicOperatorUtil::isLogicOperatorIsValue("[or]", "[eq]", "lastName[eq]=bonjour[or][and]");
        static::assertFalse($actual);
        $actual = DQLFormatFromLogicOperatorUtil::isLogicOperatorIsValue("[or]", "[eq]", "lastName[eq]=[or][and]");
        static::assertTrue($actual);
        $actual = DQLFormatFromLogicOperatorUtil::isLogicOperatorIsValue("[or]", "[eq]", "lastName[eq]=[or]");
        static::assertTrue($actual);
    }


    public function testFindNextLogicOperator(): void
    {
        $actual = DQLFormatFromLogicOperatorUtil::findNextLogicOperator("firstName[eq]=Marc[and]lastName[eq]=MAHE");
        static::assertSame("[and]", $actual);
        $actual = DQLFormatFromLogicOperatorUtil::findNextLogicOperator("firstName[or]=Marc");
        static::assertSame("[or]", $actual);
        $actual = DQLFormatFromLogicOperatorUtil::findNextLogicOperator("[or]");
        static::assertSame("[or]", $actual);
        $actual = DQLFormatFromLogicOperatorUtil::findNextLogicOperator("[bonjour]");
        static::assertSame("", $actual);
    }
    public function testIsLogicOperatorExist(): void
    {
        $actual = DQLFormatFromLogicOperatorUtil::isLogicOperatorExist("firstName[eq]=Marc[or]firstName[eq]=Marc");
        static::assertTrue($actual);
        $actual = DQLFormatFromLogicOperatorUtil::isLogicOperatorExist("firstName[eq]=Marc");
        static::assertFalse($actual);

    }

    public function testIsValueEqualToOneLogicOperator(): void
    {
        $actual = DQLFormatFromLogicOperatorUtil::isValueEqualToOneLogicOperator("[and]");
        static::assertTrue($actual);
        $actual = DQLFormatFromLogicOperatorUtil::isValueEqualToOneLogicOperator("[or]");
        static::assertTrue($actual);
        $actual = DQLFormatFromLogicOperatorUtil::isValueEqualToOneLogicOperator("[not:and]");
        static::assertTrue($actual);
        $actual = DQLFormatFromLogicOperatorUtil::isValueEqualToOneLogicOperator("[not:or]");
        static::assertTrue($actual);
        $actual = DQLFormatFromLogicOperatorUtil::isValueEqualToOneLogicOperator("bonjour");
        static::assertFalse($actual);
    }

    public function testFindLogicOperator(): void
    {
        $actual = DQLFormatFromLogicOperatorUtil::findLogicOperator("firstName[eq]=Simon[and]lastName[eq]=TOULLEC");
        static::assertSame("[and]", $actual);
        $actual = DQLFormatFromLogicOperatorUtil::findLogicOperator("firstName[eq]=Simon[or]lastName[eq]=TOULLEC");
        static::assertSame("[or]", $actual);
        $actual = DQLFormatFromLogicOperatorUtil::findLogicOperator("firstName[eq]=Simon[not:and]lastName[eq]=TOULLEC");
        static::assertSame("[not:and]", $actual);
        $actual = DQLFormatFromLogicOperatorUtil::findLogicOperator("firstName[eq]=Simon[not:or]lastName[eq]=TOULLEC");
        static::assertSame("[not:or]", $actual);
        $actual = DQLFormatFromLogicOperatorUtil::findLogicOperator("firstName[eq]=Simon[bonjour]lastName[eq]=TOULLEC");
        static::assertSame("", $actual);
    }
}