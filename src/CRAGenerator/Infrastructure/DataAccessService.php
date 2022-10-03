<?php declare(strict_types=1);

namespace CRAGenerator\Infrastructure;

// Returns a list of DTOs using injected adapters

class DataAccessService
{
    public function __construct(
        private array $adapters
    ){
        $this->adapters = $adapters;
    }

    public function fetchAllDTOs(): array
    {
        $dtos = array();
        foreach($this->adapters as $adapter)
        {
            $moreDTOs = (new $adapter())
                // Populate the $rows property with the CSV row entities
                ->setRows()
                // Build DTOs from each row entity
                ->buildDTOs();
            $dtos = array_merge($dtos,$moreDTOs);
        }
        
        return $dtos;
    }

}