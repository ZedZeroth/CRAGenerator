<?php declare(strict_types=1);

namespace CRAGenerator\Domain\Trade\DataAccess;

// This adapter converts the "LBC" CSV into an array of universal TradeDTOs

use CRAGenerator\Infrastructure\DataAdapterInterface;
use CRAGenerator\Infrastructure\ReadCSVService;

class TradeDataAdapter_LBC implements DataAdapterInterface
{
    public function __construct(){
        $this->sourceFile = (string) LBC_CSV;
    }

    public function setRows(): DataAdapterInterface
    {
        $this->rows = (new ReadCSVService($this->sourceFile))->readRows();
        return $this;
    }

    public function buildDTOs(): array
    {
        $tradeDTOs = array();
        foreach($this->rows as $row){

            if ($row['trade_type'] == 'ONLINE_SELL') {
                $userame = $row['buyer'];
            } else if ($row['trade_type'] == 'ONLINE_BUY') {
                $userame = $row['seller'];
            } else {
                new Exception('Trade neither SELL or BUY!');
            }

            array_push(
                $tradeDTOs,
                new TradeDTO(
                    $row['id'],
                    $userame
                )
            );
        }

        return $tradeDTOs;
    }
}