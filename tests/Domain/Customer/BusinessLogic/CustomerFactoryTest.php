<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\BusinessLogic\Tests;

use PHPUnit\Framework\TestCase;
use TypeError;
use stdClass;
use CRAGenerator\Domain\Customer\BusinessLogic\Customer;
use CRAGenerator\Domain\Customer\BusinessLogic\CustomerFactory;
use CRAGenerator\Domain\Customer\DataAccess\CustomerDTO;

/**
 * The customer factory test
 */

final class CustomerFactoryTest extends TestCase
{
    public function testCanBeCreatedFromValidData(): void
    {
        $this->assertInstanceOf(
            CustomerFactory::class,
            new CustomerFactory(new stdClass(), [], [])
        );
    }

    public function testCannotBeCreatedFromInvalidData(): void
    {
        $this->expectException(TypeError::class);
        new CustomerFactory('', '', '');
    }

    public function testBuildCustomers(): void
    {
        $this->assertInstanceOf(
            Customer::class,
            (new CustomerFactory(
                new CustomerDTO('', '', []),
                [],
                []
            ))->build()
        );
    }
}
