<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL\DQLClause\Util;

use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseWhereInnerJoin;
use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatFromFilterOperatorUtil;
use Stoullec\QueryFilter\DQL\DQLClause\Util\DQLFormatUtil;
use Stoullec\QueryFilter\DQL\DQLClause\Util\Validate\ValidateFilterOperator;
use Stoullec\QueryFilter\Filter\Validate\ValidateFilterProperty;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Contracts\Translation\TranslatorInterface;

final class DQLFormatUtilTest extends KernelTestCase
{
    private DQLFormatUtil $dqlFormatUtil;

    protected function setUp(): void
    {
        self::bootKernel();
        // $this->validateFilterOperator = self::getContainer()->get(ValidateFilterOperator::class);
        $t = self::getContainer()->get(TranslatorInterface::class);
        $validateFilterOperator = new ValidateFilterOperator($t);
        $validateFilterProperty = new ValidateFilterProperty($t);
        $dqlFormatFromFilterOperatorUtil = new DQLFormatFromFilterOperatorUtil($t);
        $dqlClauseWhereInnerJoin = new DQLClauseWhereInnerJoin($dqlFormatFromFilterOperatorUtil);
        $this->dqlFormatUtil = new DQLFormatUtil(
            $validateFilterOperator,
            $validateFilterProperty,
            $dqlFormatFromFilterOperatorUtil,
            $dqlClauseWhereInnerJoin
        );

    }

    public function testListOfFilterFomUrlFilter(): void
    {
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName=Simon", "director");
        static::assertSame(["firstName[eq]=Simon"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName[eq]=Simon", "director");
        static::assertSame(["firstName[eq]=Simon"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName[eq]=Marc[and]lastName[eq]=TOULLEC", "director");
        static::assertSame(["firstName[eq]=Marc", "[and]", "lastName[eq]=TOULLEC"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/person-type/filter?name[eq]=Marc[and]id[eq]=TOULLEC", "person_type");
        static::assertSame(["name[eq]=Marc", "[and]", "id[eq]=TOULLEC"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName[eq]=Marc[and]lastName[eq]=TOULLEC[and]lastName[eq]=TOULLEC", "director");
        static::assertSame(["firstName[eq]=Marc", "[and]", "lastName[eq]=TOULLEC", "[and]", "lastName[eq]=TOULLEC"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName[eq]=Marc[and]lastName[eq]=TOULLEC[and]salary[eq]=1500", "director");
        static::assertSame(["firstName[eq]=Marc", "[and]", "lastName[eq]=TOULLEC", "[and]", "salary[eq]=1500"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName[eq]=Marc[and]lastName[eq]=TOULLEC[or]salary[eq]=1500", "director");
        static::assertSame(["firstName[eq]=Marc", "[and]", "lastName[eq]=TOULLEC", "[or]", "salary[eq]=1500"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName[ctn]=Marc", "director");
        static::assertSame(["firstName[ctn]=Marc"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName[ctn]=Marc[and]lastName[eq]=TOULLEC", "director");
        static::assertSame(["firstName[ctn]=Marc", "[and]", "lastName[eq]=TOULLEC"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName[ctn]=Marc[and]lastName[eq]=TOULLEC[and]salary[btw]=1500,1700", "director");
        static::assertSame(["firstName[ctn]=Marc", "[and]", "lastName[eq]=TOULLEC", "[and]", "salary[btw]=1500,1700"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName[ctn]=Marc[not:and]lastName[eq]=TOULLEC[or]salary[btw]=1500,1700", "director");
        static::assertSame(["firstName[ctn]=Marc", "[not:and]", "lastName[eq]=TOULLEC", "[or]", "salary[btw]=1500,1700"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName[eq]=Marc[andlastName[eq]=TOULLEC", "director");
        static::assertSame(["firstName[eq]=Marc[andlastName"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName[eq]=Marc[andlastName[eq]=TOULLEC[and]", "director");
        static::assertSame(["firstName[eq]=Marc[andlastName[eq]=TOULLEC", "[and]"], $actual);
        $actual = $this->dqlFormatUtil->getListOfFilterFomUrlFilter("/director/filter?firstName[eq]=Marc[andlastName[eq]=TOULLEC[and]lastName[eq]=TOULLEC", "director");
        static::assertSame(["firstName[eq]=Marc[andlastName[eq]=TOULLEC", "[and]", "lastName[eq]=TOULLEC"], $actual);
    }

    /**
     * @dataProvider provider
     */
    public function testListOfDQLFormatError(string $message, string $urlFilter, string $tableAlias): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage($message);
        $this->dqlFormatUtil->getListOfFilterFomUrlFilter($urlFilter, $tableAlias);
    }

    public function provider(): array
    {
        return [
            [
                "[[and]id] This property not exist in person_type",
                "/person-type/filter?name[eq]=Marc[and][and]id[eq]=TOULLEC",
                "person_type"
            ],
            [
                "[bonjour] This property not exist in director",
                "/director/filter?bonjour=Simon",
                "director"
            ],
            [
                "[firstName[eq]Simon] This property not exist in director",
                "/director/filter?firstName[eq]Simon",
                "director"
            ],
            [
                "[bonjour] This property not exist in director",
                "/director/filter?bonjour[eq]=Simon",
                "director"
            ],
            [
                "[bonjour] This property not exist in person_type",
                "/person-type/filter?bonjour[eq]=Simon",
                "person_type"
            ],
            [
                "[[and]id] This property not exist in person_type",
                "/person-type/filter?name[eq]=Marc[and][and]id[eq]=TOULLEC",
                "person_type"
            ],
            [
                "[[and]name] This property not exist in person_type",
                "/person-type/filter?name[eq]=Marc[and][and]name[ctn]=TOULLEC",
                "person_type"
            ],
            [
                "[bonjour] This property not exist in director",
                "/director/filter?firstName[eq]=Simon[and]bonjour[eq]=Simon",
                "director"
            ],
            [
                "[] This property not exist in director",
                "/director/filter?[eq]=",
                "director"
            ],
            [
                "[[eq]] This property not exist in director",
                "/director/filter?[eq]",
                "director"
            ],
            [
                "At least one filter operator([eq], [btw], etc...) is required.",
                "/director/filter?[and]",
                "director"
            ],
        ];
    }
}