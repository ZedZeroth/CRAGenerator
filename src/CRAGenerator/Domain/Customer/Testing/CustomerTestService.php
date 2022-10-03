<?php declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\Testing;

// Tests customer domain classes and methods

use CRAGenerator\Infrastructure\TestServiceInterface;
use CRAGenerator\Infrastructure\DataAccessService;
use CRAGenerator\Domain\Customer\BusinessLogic\CustomerFactory;
use CRAGenerator\Domain\Customer\DataAccess\CustomerDataAdapter_BUY;
use CRAGenerator\Domain\Trade\BusinessLogic\TradeFactory;
use CRAGenerator\Domain\Trade\DataAccess\TradeDataAdapter_LBC;

class CustomerTestService implements TestServiceInterface
{
    public function __construct(){}

    public function test(): void
    {
        echo('Running CUSTOMER tests... ');

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

        // Fetch customer DTOs
        $customerDTOs = (array) (new DataAccessService(
            [new CustomerDataAdapter_BUY()]
        ))->fetchAllDTOs();
        
        // Instantiate customers from DTOs
        $customers = array();
        foreach($customerDTOs as $customerDTO){
            $customer = (new CustomerFactory(
                $customerDTO,
                $trades,
                []
            ))->build();
            array_push($customers, $customer);
        }

        // Test getUsername method
        foreach($customers as $customer){
            assert(
                $customer->getUsername('lbc').PHP_EOL
            );
        }

        // Check trades have been assigned to customers
        foreach($customers as $customer){
            assert(
                $customer->getUsername('lbc').": "
            );
            foreach($customer->getTrades() as $trade){
                assert(
                    $trade->getId()." "
                );
            }
            assert(PHP_EOL);
        }

        echo('COMPLETE'.PHP_EOL);

        return;
    }


}