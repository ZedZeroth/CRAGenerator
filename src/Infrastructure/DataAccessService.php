<?php

declare(strict_types=1);

namespace CRAGenerator\Infrastructure;

// Returns a list of DTOs using injected adapters

final class DataAccessService
{
    public function __construct(
        private array $adapters
    ) {
    }

    public function fetchAllDTOs(): array
    {
        $dtos = [];
        foreach ($this->adapters as $adapter) {
            $moreDTOs = $adapter
                // Build DTOs from each row entity
                ->buildDTOs();
            $dtos = array_merge($dtos, $moreDTOs);
        }

        return $dtos;
    }
}
