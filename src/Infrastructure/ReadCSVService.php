<?php

declare(strict_types=1);

namespace CRAGenerator\Infrastructure;

/**
 * Creates an associative array from CSV headers and rows
 */

final class ReadCSVService
{
    public function __construct(
        private string $csvFilePath
    ) {
    }

    public function readRows(): array
    {
        $csvArray = array_map('str_getcsv', file($this->csvFilePath));

        $entities = [];
        $firstRow = true;
        foreach ($csvArray as $row) {
            /* Convert first row into headers */
            if ($firstRow) {
                $headers = $row;
                $firstRow = false;

            /* Create row "entities" by assigning headers as array keys for the cells of each remaining row */
            } else {
                $count = 0;
                $entity = [];
                foreach ($row as $cell) {
                    $entity[$headers[$count]] = $cell;
                    $count++;
                }
                array_push($entities, $entity);
            }
        }
        return $entities;
    }
}
