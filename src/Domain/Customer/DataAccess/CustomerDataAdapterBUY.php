<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\DataAccess;

use CRAGenerator\Infrastructure\DataAdapterInterface;
use CRAGenerator\Infrastructure\ReadCSVService;

/**
 * This adapter converts the "BUY" CSV into an array of universal CustomerDTOs
 */

final class CustomerDataAdapterBUY implements DataAdapterInterface
{
    public function __construct(
        private array $rows
    ) {
    }

    public function buildDTOs(): array
    {
        $customerDTOs = [];
        foreach ($this->rows as $row) {
            /* Build platform username array */
            $usernames = [];
            if ($row['LBC USERNAME']) {
                $usernames['lbc'] = $row['LBC USERNAME'];
            }
            if ($row['EMAIL']) {
                $usernames['zzc'] = $row['EMAIL'];
            }

            /* Build DTOs */
            array_push(
                $customerDTOs,
                new CustomerDTO(
                    /* These array keys are specific to the CSV column headers */
                    (string) $row['ID SURNAME'],
                    (string) $row['GIVEN NAME 1'],
                    (array) $usernames
                )
            );
        }
        return $customerDTOs;
    }
}
