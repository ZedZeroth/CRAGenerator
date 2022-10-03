<?php declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\DataAccess;

// The customer DTO

use CRAGenerator\Infrastructure\DTOInterface;

class CustomerDTO implements DTOInterface
{
    public function __construct(

        // Identity
        public string $familyName,
        public string $givenName,

        // Platforms
        public array $usernames
        
    ){}
}