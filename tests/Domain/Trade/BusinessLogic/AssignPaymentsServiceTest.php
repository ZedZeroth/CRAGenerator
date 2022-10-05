<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Trade\BusinessLogic\Tests;

// Include constants
require '../../cra_data/const/const.php';

use PHPUnit\Framework\TestCase;
use TypeError;
use stdClass;
use CRAGenerator\Domain\Trade\BusinessLogic\AssignPaymentsService;
use CRAGenerator\Domain\Trade\BusinessLogic\Trade;
use CRAGenerator\Domain\Payment\BusinessLogic\Payment;

/**
 * The fetch trade payment test
 */

final class AssignPaymentsServiceTest extends TestCase
{
    public function testCanBeCreatedFromValidData(): void
    {
        $this->assertInstanceOf(
            AssignPaymentsService::class,
            new AssignPaymentsService(
                new Trade([], '', '', '', 0),
                []
            )
        );
    }

    public function testCannotBeCreatedFromInvalidData(): void
    {
        $this->expectException(TypeError::class);
        new AssignPaymentsService(
            new stdClass(),
            []
        );
    }

    public function testReferenceMatching(): void
    {
        $method = new \ReflectionMethod(
            'CRAGenerator\Domain\Trade\BusinessLogic\AssignPaymentsService',
            'isMatchingReference'
        );
        $method->setAccessible(true);

        $this->assertIsBool(
            $method->invoke(
                new AssignPaymentsService(
                    new Trade([], '', '', '', 0),
                    []
                ),
                new Payment(false, '', '', '', 0)
            )
        );
    }

    public function testAmountMatching(): void
    {
        $method = new \ReflectionMethod(
            'CRAGenerator\Domain\Trade\BusinessLogic\AssignPaymentsService',
            'isMatchingPenceAmount'
        );
        $method->setAccessible(true);

        $this->assertIsBool(
            $method->invoke(
                new AssignPaymentsService(
                    new Trade([], '', '', '', 0),
                    []
                ),
                new Payment(false, '', '', '', 0)
            )
        );
    }
}
