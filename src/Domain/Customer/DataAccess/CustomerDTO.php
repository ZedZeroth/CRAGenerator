<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\DataAccess;

/**
 * The customer DTO
 */

final class CustomerDTO
{
    public function __construct(
        /* Identity */
        public string $familyName,
        public string $givenName,
        /* Platforms */
        public array $usernames
    ) {
    }
}
