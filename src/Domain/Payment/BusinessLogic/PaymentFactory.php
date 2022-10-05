<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Payment\BusinessLogic;

/**
 * Instantiates a payment from its DTO
 */

final class PaymentFactory
{
    public function __construct(
        /* The payment's properties are built from the DTO */
        private object $dto
    ) {
    }

    public function build(): Payment
    {
        return (
            new Payment(
                false, /* Not assigned to trade */
                $this->dto->id,
                $this->dto->reference,
                $this->dto->customerAccountName,
                $this->dto->penceAmount
            ));
    }
}
