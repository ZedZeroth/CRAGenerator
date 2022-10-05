<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Trade\BusinessLogic;

/**
 * Instantiates a trade from its DTO and dependencies
 */

final class TradeFactory
{
    public function __construct(
        /* The trade's properties are built from the DTO */
        private object $dto,
        /* The trade's payment(s) is/are fetched from this array of all payments */
        private array $allPayments
    ) {
    }

    public function build(): Trade
    {
        return (
            new Trade(
                [], /* No payments assigned yet */
                (string) $this->dto->platform,
                (string) $this->dto->id,
                (string) $this->dto->username,
                (int) $this->dto->penceAmount
            )
        /* Assign payments from the full list of payments */
        )->assignPayment($this->allPayments);
    }
}
