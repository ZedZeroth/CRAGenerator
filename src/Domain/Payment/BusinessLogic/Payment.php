<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Payment\BusinessLogic;

/**
 * The payment model
 */

final class Payment
{
    public function __construct(
        /* Is an undefined bool false or null? */
        private bool $assigned,
        private string $id,
        private string $reference,
        private string $customerAccountName,
        private int $penceAmount
    ) {
        $this->correctReferenceError();
    }

    private function correctReferenceError(): void
    {
        /* Correct payments when customer used an incorrect reference */
        foreach (CORRECT_REFERENCES as $correction) {
            if ($this->id == $correction['paymentId']) {
                $this->reference = (string) $correction['reference'];
                $this->penceAmount = (int) $correction['forcedAmount'];
            }
        }
    }

    // Getters

    public function isAssigned(): bool
    {
        return $this->assigned;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getCustomerAccountName(): string
    {
        return $this->customerAccountName;
    }

    public function getPenceAmount(): int
    {
        return $this->penceAmount;
    }

    // Setters

    public function setAssigned(bool $assigned): void
    {
        $this->assigned = (bool) $assigned;
    }
}
