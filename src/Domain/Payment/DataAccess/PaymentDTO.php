<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Payment\DataAccess;

/**
 * The payment DTO
 */

final class PaymentDTO
{
    public function __construct(
        public string $id,
        public string $reference,
        public string $customerAccountName,
        public int $penceAmount
    ) {
    }
}
