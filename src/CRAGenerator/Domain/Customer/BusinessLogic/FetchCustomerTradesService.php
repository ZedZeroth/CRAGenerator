<?php declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\BusinessLogic;

// Fetches a specified customer's trades

class FetchCustomerTradesService
{
    public function __construct(
        private Customer $customer,
        private array $allTrades
    ){
        $this->customer = $customer;
        $this->allTrades = (array) $allTrades;
    }

    public function fetch(): array
    {
        $matchedTrades = array();
        foreach ($this->allTrades as $trade) {
            if ($trade->getUsername() == $this->customer->getUsername('lbc')) {
                array_push($matchedTrades, $trade);
            }
        }
        return $matchedTrades;
    }

}