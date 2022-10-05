<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Trade\DataAccess;

/**
 * The trade DTO
 */

final class TradeDTO
{
    public function __construct(
        public string $platform,
        public string $id,
        public string $username,
        public int $penceAmount
    ) {
    }
}
