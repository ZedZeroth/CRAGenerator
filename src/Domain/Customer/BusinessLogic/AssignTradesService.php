<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\BusinessLogic;

/**
 * Fetches a specified customer's trades
 */

final class AssignTradesService
{
    public function __construct(
        private Customer $customer,
        private array $allTrades
    ) {
    }

    public function fetch(): array
    {
        $matchedTrades = [];
        foreach ($this->allTrades as $trade) {
            /*💬*/ //echo($trade->getUsername());
            if (
                $trade->getUsername() ==
                $this->customer->getUsername(
                    $trade->getPlatform()
                )
            ) {
                array_push($matchedTrades, $trade);
            }
        }
        return $matchedTrades;
    }
}
