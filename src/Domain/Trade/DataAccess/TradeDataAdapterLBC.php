<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Trade\DataAccess;

use Exception;
use CRAGenerator\Infrastructure\DataAdapterInterface;
use CRAGenerator\Infrastructure\ReadCSVService;

/**
 * This adapter converts the "LBC" CSV into an array of universal TradeDTOs
 */

final class TradeDataAdapterLBC implements DataAdapterInterface
{
    public function __construct(
        private array $rows
    ) {
    }

    public function buildDTOs(): array
    {
        $tradeDTOs = [];
        foreach ($this->rows as $row) {
            try {
                /* Determine customer username based on trade direction */
                if ($row['trade_type'] == 'ONLINE_SELL') {
                    $userame = $row['buyer'];
                } elseif ($row['trade_type'] == 'ONLINE_BUY') {
                    $userame = $row['seller'];
                } else {
                    throw new Exception('Trade neither SELL or BUY!');
                }

                array_push(
                    $tradeDTOs,
                    new TradeDTO(
                        (string) 'lbc',
                        (string) $row['id'],
                        (string) $userame,
                        (int) ($row['fiat_amount'] * 100)
                    )
                );
            } catch (Exception $e) {
                echo($e);
            }
        }

        return $tradeDTOs;
    }
}
