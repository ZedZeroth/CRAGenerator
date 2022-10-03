<?php declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\BusinessLogic;

// Instantiates a customer from its DTO and dependencies

use CRAGenerator\Infrastructure\DTOInterface;

class CustomerFactory
{
    public function __construct(
        // The customer's properties are built from the DTO
        private DTOInterface $dto,
        // The customer's trades are fetched from this array of all trades
        private array $allTrades,
        // Assessments coming soon
        private array $assessments
    ){
        $this->dto = $dto;
        $this->allTrades = (array) $allTrades;
        $this->assessments = (array) $assessments;
    }

    public function build(): Customer
    {
        /*💬*/ //echo($this->dto->familyName);

        return (
            new Customer(
                $this->dto->familyName,
                $this->dto->givenName,
                $this->dto->usernames
            )
        // Assign trades from the full trade list
        )->assignTrades($this->allTrades);
    }
}