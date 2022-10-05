<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\BusinessLogic\Tests;

use PHPUnit\Framework\TestCase;
use TypeError;
use CRAGenerator\Domain\Customer\BusinessLogic\Customer;

/**
 * The customer model test
 */

final class CustomerTest extends TestCase
{
    public function testCanBeCreatedFromValidData(): void
    {
        $this->assertInstanceOf(
            Customer::class,
            new Customer([], [], '', '', [])
        );
    }

    public function testCannotBeCreatedFromInvalidData(): void
    {
        $this->expectException(TypeError::class);
        new Customer('', '', '');
    }

    public function testTradeAssignment(): void
    {
        $this->assertInstanceOf(
            Customer::class,
            (new Customer([], [], '', '', []))->assignTrades([])
        );
    }
}
