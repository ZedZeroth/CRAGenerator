<?php declare(strict_types=1);

namespace CRAGenerator\Domain\Trade\BusinessLogic;

// Instantiates a trade from its DTO and dependencies

use CRAGenerator\Infrastructure\DTOInterface;

class TradeFactory
{
    public function __construct(
        // The trade's properties are built from the DTO
        private DTOInterface $dto,
        // The trade's payment is fetched from this array of all payments
        private array $allPayments
    ){
        $this->dto = $dto;
        $this->allPayments = (array) $allPayments;
    }

    public function build(): Trade
    {
        return new Trade(
            $this->dto->id,
            $this->dto->username,
        ); // Assign payments coming soon
    }

}