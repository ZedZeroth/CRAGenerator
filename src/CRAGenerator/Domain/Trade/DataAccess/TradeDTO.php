<?php declare(strict_types=1);

namespace CRAGenerator\Domain\Trade\DataAccess;

// The trade DTO

use CRAGenerator\Infrastructure\DTOInterface;

class TradeDTO implements DTOInterface
{
    public function __construct(

        public string $id,
        public string $username
        
    ){}
}