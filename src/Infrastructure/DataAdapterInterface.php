<?php

declare(strict_types=1);

namespace CRAGenerator\Infrastructure;

/**
 * The data adapter interface
 */

interface DataAdapterInterface
{
    public function buildDTOs(): array;
}
