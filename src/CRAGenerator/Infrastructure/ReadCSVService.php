<?php declare(strict_types=1);

namespace CRAGenerator\Infrastructure;

// Creates an associative array from CSV headers and rows

class ReadCSVService
{
    public function __construct(string $csvFilePath){
        $this->csvFilePath = (string) $csvFilePath;
    }

    public function readRows(): array
    {
        $csvArray = array_map( 'str_getcsv', file( $this->csvFilePath ) );

        $entities = array();
        $firstRow = True;
        foreach ($csvArray as $row) {
            
            // Convert first row into headers
            if ($firstRow) {
                $headers = $row;
                $firstRow = False;
            
            // Create row "entities" by assigning headers as array keys for the cells of each remaining row
            } else {
                $count = 0;
                $entity = array();
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