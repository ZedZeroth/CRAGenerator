<?php declare(strict_types=1);

namespace CRAGenerator\Domain\Trade\Testing;

// Tests trade domain classes and methods

use CRAGenerator\Infrastructure\TestServiceInterface;
use CRAGenerator\Infrastructure\DataAccessService;
use CRAGenerator\Domain\Trade\BusinessLogic\TradeFactory;
use CRAGenerator\Domain\Trade\DataAccess\TradeDataAdapter_LBC;

class TradeTestService implements TestServiceInterface
{
    public function __construct(){}

    public function test(): void
    {
        echo('Running TRADE tests... ');

        // Fetch trade DTOs
        $tradeDTOs = (array) (new DataAccessService(
            [new TradeDataAdapter_LBC()]
        ))->fetchAllDTOs();
        
        // Instantiate trades from DTOs
        $trades = array();
        foreach($tradeDTOs as $tradeDTO){
            $trade = (new TradeFactory(
                $tradeDTO,
                []
            ))->build();
            array_push($trades, $trade);
        }

        // Test getId method
        foreach($trades as $trade){
            assert(
                $trade->getId().PHP_EOL
            );
        }

        echo('COMPLETE'.PHP_EOL);

        return;
    }


}