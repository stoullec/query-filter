<?php

namespace App\Tests\Unit\Service\QueryFilter\DQL\DQLClause;

use Stoullec\QueryFilter\DQL\DQLClause\DQLClauseWhere;
use Stoullec\QueryFilter\DQL\DQLClause\Util\Validate\ValidateFilterOperator;
use Stoullec\QueryFilter\Filter\Validate\ValidateFilterProperty;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Contracts\Translation\TranslatorInterface;

final class DQLClauseWhereTest extends KernelTestCase
{
    private DQLClauseWhere $dqlClauseWhere;

    protected function setUp(): void
    {
        self::bootKernel();
        $t = self::getContainer()->get(TranslatorInterface::class);
        $validateFilterOperator = new ValidateFilterOperator($t);
        $validateFilterProperty = new ValidateFilterProperty($t);
        $this->dqlClauseWhere = new DQLClauseWhere(
            $validateFilterOperator,
            $validateFilterProperty
        );

    }

    public function testGetDQL(): void
    {
        $actual = $this->dqlClauseWhere->getDQL(["firstName[ctn]=Simon"], 'director');
        static::assertSame('WHERE director.firstName LIKE \'%Simon%\'', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["firstName[not:ctn]=Simon"], 'director');
        static::assertSame('WHERE NOT (director.firstName LIKE \'%Simon%\')', $actual);

        $actual = $this->dqlClauseWhere->getDQL(["personType.name[ctn]=Simon"], 'director');
        static::assertSame('WHERE person_type.name LIKE \'%Simon%\'', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["personType.name[not:ctn]=Simon"], 'director');
        static::assertSame('WHERE NOT (person_type.name LIKE \'%Simon%\')', $actual);

        $actual = $this->dqlClauseWhere->getDQL(["firstName[sw]=Sim"], 'director');
        static::assertSame('WHERE director.firstName LIKE \'Sim%\'', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["firstName[not:sw]=Sim"], 'director');
        static::assertSame('WHERE NOT (director.firstName LIKE \'Sim%\')', $actual);

        $actual = $this->dqlClauseWhere->getDQL(["firstName[ew]=mon"], 'director');
        static::assertSame('WHERE director.firstName LIKE \'%mon\'', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["firstName[not:ew]=mon"], 'director');
        static::assertSame('WHERE NOT (director.firstName LIKE \'%mon\')', $actual);

        $actual = $this->dqlClauseWhere->getDQL(["salary[btw]=1500,1700"], 'director');
        static::assertSame('WHERE director.salary BETWEEN \'1500\' AND \'1700\'', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["salary[not:btw]=1500,1700"], 'director');
        static::assertSame('WHERE NOT (director.salary BETWEEN \'1500\' AND \'1700\')', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["salary[btw]=1700"], 'director');
        static::assertSame('WHERE director.salary BETWEEN \'0\' AND \'1700\'', $actual);

        $actual = $this->dqlClauseWhere->getDQL(["salary[gte]=1500"], 'director');
        static::assertSame('WHERE director.salary >= 1500', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["salary[not:gte]=1500"], 'director');
        static::assertSame('WHERE NOT (director.salary >= 1500)', $actual);

        $actual = $this->dqlClauseWhere->getDQL(["salary[gt]=1500"], 'director');
        static::assertSame('WHERE director.salary > 1500', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["salary[not:gt]=1500"], 'director');
        static::assertSame('WHERE NOT (director.salary > 1500)', $actual);

        $actual = $this->dqlClauseWhere->getDQL(["salary[ste]=1500"], 'director');
        static::assertSame('WHERE director.salary <= 1500', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["salary[not:ste]=1500"], 'director');
        static::assertSame('WHERE NOT (director.salary <= 1500)', $actual);

        $actual = $this->dqlClauseWhere->getDQL(["salary[st]=1500"], 'director');
        static::assertSame('WHERE director.salary < 1500', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["salary[not:st]=1500"], 'director');
        static::assertSame('WHERE NOT (director.salary < 1500)', $actual);

        $actual = $this->dqlClauseWhere->getDQL(["id[eq]=1"], 'director');
        static::assertSame('WHERE director.id = \'1\'', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["id=1"], 'director');
        static::assertSame('WHERE director.id = \'1\'', $actual);
        $actual = $this->dqlClauseWhere->getDQL(['firstName[eq]="Simon"'], 'director');
        static::assertSame('WHERE director.firstName = \'Simon\'', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["firstName[eq]='Simon'"], 'director');
        static::assertSame('WHERE director.firstName = \'Simon\'', $actual);

        $actual = $this->dqlClauseWhere->getDQL(["firstName[not:eq]=Simon"], 'director');
        static::assertSame('WHERE NOT (director.firstName = \'Simon\')', $actual);

        // ==== LOGIC operator
        $actual = $this->dqlClauseWhere->getDQL(["firstName[eq]=Laurent", "[and]", "lastName[eq]=TOULLEC"], 'director');
        static::assertSame('WHERE director.firstName = \'Laurent\' AND director.lastName = \'TOULLEC\'', $actual);

        $actual = $this->dqlClauseWhere->getDQL(["firstName[eq]=Laurent", "[or]", "lastName[eq]=TOULLEC"], 'director');
        static::assertSame('WHERE director.firstName = \'Laurent\' OR director.lastName = \'TOULLEC\'', $actual);

        $actual = $this->dqlClauseWhere->getDQL(["firstName[eq]=Laurent", "[and]", "lastName[eq]=TOULLEC", "[and]", "lastName[eq]=TOULLEC"], 'director');
        static::assertSame('WHERE director.firstName = \'Laurent\' AND director.lastName = \'TOULLEC\' AND director.lastName = \'TOULLEC\'', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["firstName[eq]=Laurent", "[or]", "lastName[eq]=TOULLEC", "[or]", "lastName[eq]=TOULLEC"], 'director');

        static::assertSame('WHERE director.firstName = \'Laurent\' OR director.lastName = \'TOULLEC\' OR director.lastName = \'TOULLEC\'', $actual);
        $actual = $this->dqlClauseWhere->getDQL(["firstName[eq]=Laurent", "[or]", "lastName[eq]=TOULLEC", "[and]", "lastName[eq]=TOULLEC"], 'director');
        static::assertSame('WHERE director.firstName = \'Laurent\' OR director.lastName = \'TOULLEC\' AND director.lastName = \'TOULLEC\'', $actual);
    }
}