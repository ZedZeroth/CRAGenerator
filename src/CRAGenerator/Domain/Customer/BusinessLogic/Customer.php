<?php declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\BusinessLogic;

// The customer model

class Customer
{
    public function __construct(

        // Identity
        private string $familyName,
        private string $givenName,

        // Platforms
        private array $usernames // An associative array of this customer's usernames on different platforms

    ){
        // Identity
        $this->familyName = (string) $familyName;
        $this->givenName = (string) $givenName;
        
        // Platforms
        $this->usernames = (array) $usernames;
    }

    public function getUsername(string $platform): string
    {
        return $this->usernames[$platform];
    }

    public function getTrades(): array
    {
        return $this->trades;
    }

    public function assignTrades(array $allTrades): Customer
    {
        $this->trades = (new FetchCustomerTradesService($this, $allTrades))->fetch();
        return $this;
    }


}