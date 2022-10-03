<?php declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\DataAccess;

// This adapter converts the "BUY" CSV into an array of universal CustomerDTOs

use CRAGenerator\Infrastructure\DataAdapterInterface;
use CRAGenerator\Infrastructure\ReadCSVService;

class CustomerDataAdapter_BUY implements DataAdapterInterface
{
    public function __construct(){
        $this->sourceFile = (string) BUY_CSV;
    }

    public function setRows(): DataAdapterInterface
    {
        $this->rows = (new ReadCSVService($this->sourceFile))->readRows();
        return $this;
    }

    public function buildDTOs(): array
    {        
        $customerDTOs = array();
        foreach($this->rows as $row){
            array_push(
                $customerDTOs,
                new CustomerDTO(
                    // These array keys are specific to the CSV column headers
                    $row['ID SURNAME'],
                    $row['GIVEN NAME 1'],
                    [
                        'lbc' => $row['LBC USERNAME']
                    ]
                )
            );
        }

        return $customerDTOs;
    }
}