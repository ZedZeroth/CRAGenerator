<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Trade\BusinessLogic;

use CRAGenerator\Domain\Payment\BusinessLogic\Payment;

/**
 * The trade model
 */

final class Trade
{
    public function __construct(
        private array $payments,
        private string $platform,
        private string $id,
        private string $username,
        private int $penceAmount
    ) {
    }

    public function assignPayment(array $allPayments): Trade //Chainable
    {
        /* If matching payment found push to payment array */
        $assignedPayment = (new AssignPaymentsService($this, $allPayments))->assign();
        if ($assignedPayment) {
            array_push(
                $this->payments,
                $assignedPayment
            );
        }
        return $this;
    }

    // Getters

    public function getPlatform(): string
    {
        return $this->platform;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPenceAmount(): int
    {
        return $this->penceAmount;
    }

    public function getPayments(): array
    {
        return $this->payments;
    }
}
