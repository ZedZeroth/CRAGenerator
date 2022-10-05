<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\BusinessLogic\Tests;

use PHPUnit\Framework\TestCase;
use TypeError;
use stdClass;
use CRAGenerator\Domain\Customer\BusinessLogic\AssignTradesService;
use CRAGenerator\Domain\Customer\BusinessLogic\Customer;

/**
 * The fetch customer trades test
 */

final class AssignTradesServiceTest extends TestCase
{
    public function testCanBeCreatedFromValidData(): void
    {
        $this->assertInstanceOf(
            AssignTradesService::class,
            new AssignTradesService(
                new Customer([], [], '', '', []),
                []
            )
        );
    }

    public function testCannotBeCreatedFromInvalidData(): void
    {
        $this->expectException(TypeError::class);
        new AssignTradesService(
            new stdClass(),
            []
        );
    }

    public function testFetchTrades(): void
    {
        $this->assertIsArray(
            (new AssignTradesService(
                new Customer([], [], '', '', []),
                []
            ))->fetch()
        );
    }
}
