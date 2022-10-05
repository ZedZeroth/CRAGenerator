<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Payment\DataAccess;

use Exception;
use CRAGenerator\Infrastructure\DataAdapterInterface;
use CRAGenerator\Infrastructure\ReadCSVService;

/**
 * This adapter converts the "ENU" CSV into an array of universal PaymentDTOs
 */

final class PaymentDataAdapterENU implements DataAdapterInterface
{
    public function __construct(
        private array $rows
    ) {
    }

    public function buildDTOs(): array
    {
        $paymentDTOs = [];
        foreach ($this->rows as $row) {
            try {
                /* Strip negative signs */
                $amountRaw = (string) str_replace('-', '', $row['Amount Raw']);

                /* Strip commas */
                $amountRaw = (string) str_replace(',', '', $amountRaw);

                /* Check amount is numeric */
                if (is_numeric($amountRaw)) {
                    $penceAmount = (int) abs($amountRaw * 100);
                } else {
                    throw new Exception("\033[47m{$row['Reference']}: {$amountRaw} is not numeric!\033[0m");
                }

                // Build DTOs
                array_push(
                    $paymentDTOs,
                    new PaymentDTO(
                        /* These array keys are specific to the CSV column headers */
                        (string) $row['Transaction Id'],
                        (string) $row['Reference'],
                        (string) $row['AccountName'],
                        (int) $penceAmount
                    )
                );
            } catch (Exception $e) {
                echo("$e");
            }
        }
        return $paymentDTOs;
    }
}
