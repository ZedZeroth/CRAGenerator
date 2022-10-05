<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\BusinessLogic\Tests;

use PHPUnit\Framework\TestCase;
use TypeError;
use stdClass;
use CRAGenerator\Domain\Customer\BusinessLogic\BuildAssessmentsService;
use CRAGenerator\Domain\Customer\BusinessLogic\Customer;

/**
 * The build customer assessments test
 */

final class BuildAssessmentsServiceTest extends TestCase
{
    public function testCanBeCreatedFromValidData(): void
    {
        $this->assertInstanceOf(
            BuildAssessmentsService::class,
            new BuildAssessmentsService(
                new Customer([], [], '', '', [])
            )
        );
    }

    public function testCannotBeCreatedFromInvalidData(): void
    {
        $this->expectException(TypeError::class);
        new BuildAssessmentsService(
            new stdClass()
        );
    }

    public function testBuildEachAssessment(): void
    {
        $this->assertInstanceOf(
            Customer::class,
            (new BuildAssessmentsService(
                new Customer([], [], '', '', [])
            ))->buildEachAssessment()
        );
    }
}
