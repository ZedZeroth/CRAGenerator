<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\BusinessLogic;

/**
 * Instantiates a customer from its DTO and assigns their trades
 */

final class CustomerFactory
{
    public function __construct(
        /* The customer's properties are built from the DTO */
        private object $dto,
        /* The customer's trades are fetched from this array of all trades */
        private array $allTrades
    ) {
    }

    public function build(): Customer
    {
        return (
            new Customer(
                (array) [],
                (array) [],
                (string) $this->dto->familyName,
                (string) $this->dto->givenName,
                (array) $this->dto->usernames
            )
        /* Assign trades from the full trade list */
        )
            ->assignTrades($this->allTrades)
            ->calculateRisks();
    }
}
