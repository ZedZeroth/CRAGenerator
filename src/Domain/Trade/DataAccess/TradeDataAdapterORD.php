<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Trade\DataAccess;

use Exception;
use CRAGenerator\Infrastructure\DataAdapterInterface;
use CRAGenerator\Infrastructure\ReadCSVService;

/**
 * This adapter converts the "ORD" CSV into an array of universal TradeDTOs
 */

final class TradeDataAdapterORD implements DataAdapterInterface
{
    public function __construct(
        private array $rows
    ) {
    }

    public function buildDTOs(): array
    {
        $tradeDTOs = [];
        foreach ($this->rows as $row) {
            array_push(
                $tradeDTOs,
                new TradeDTO(
                    (string) 'zzc',
                    (string) $row['ref'],
                    (string) $row['email'],
                    (int) ($row['gbp'] * 100)
                )
            );
        }

        return $tradeDTOs;
    }
}
