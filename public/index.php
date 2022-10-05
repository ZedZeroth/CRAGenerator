<?php

declare(strict_types=1);

/*💬*/ //echo 'This comment syntax is used to temporarily echo debug messages';

// Composer autoloader
require '../vendor/autoload.php';

// Include constants
require '../init/constants.php';
require '../../cra_data/const/const.php';

use CRAGenerator\Infrastructure\DataAccessService;
use CRAGenerator\Infrastructure\ReadCSVService;

use CRAGenerator\Domain\Payment\BusinessLogic\PaymentFactory;
use CRAGenerator\Domain\Payment\DataAccess\PaymentDataAdapterENU;

use CRAGenerator\Domain\Trade\BusinessLogic\TradeFactory;
use CRAGenerator\Domain\Trade\DataAccess\TradeDataAdapterLBC;
use CRAGenerator\Domain\Trade\DataAccess\TradeDataAdapterORD;

use CRAGenerator\Domain\Customer\BusinessLogic\CustomerFactory;
use CRAGenerator\Domain\Customer\DataAccess\CustomerDataAdapterBUY;

/* Instantiate customers, assign trades/payments, calculate risk scores... */

        /*💬*/ echo 'Building payments... ';

        // Fetch payment DTOs
        $paymentDTOs = (array) (new DataAccessService([
            new PaymentDataAdapterENU((new ReadCSVService(ENU_CSV))->readRows()),
        ]))->fetchAllDTOs();

        // Instantiate payments from DTOs
        $payments = [];
        foreach ($paymentDTOs as $paymentDTO) {
            $payment = (new PaymentFactory(
                $paymentDTO
            ))->build();
            array_push($payments, $payment);
        }

        /*💬*/ echo 'Done.' . PHP_EOL;

        /*💬*/ echo 'Building trades... ';

        // Fetch trade DTOs
        $tradeDTOs = (array) (new DataAccessService([
            new TradeDataAdapterLBC((new ReadCSVService(LBC_CSV))->readRows()),
            new TradeDataAdapterORD((new ReadCSVService(ORD_CSV))->readRows())
        ]))->fetchAllDTOs();

        // Instantiate trades from DTOs
        $trades = [];
        foreach ($tradeDTOs as $tradeDTO) {
            $trade = (new TradeFactory(
                $tradeDTO,
                $payments
            ))->build();
            array_push($trades, $trade);
        }

        /*💬*/ echo 'Done.' . PHP_EOL;

        /*💬*/ echo 'Checking trades with no payment... ' . PHP_EOL;

        // Check payments have been assigned to trades
        foreach ($trades as $trade) {
            if (!$trade->getPayments()) {
                assert(
                    "{$trade->getId()}" . PHP_EOL
                );
            }
        }

        /*💬*/ echo '... Done.' . PHP_EOL;

        /*💬*/ echo 'Checking unassigned payments... ' . PHP_EOL;

        // List unassigned payments
        foreach ($payments as $payment) {
            if (!$payment->isAssigned()) {
                if (!in_array($payment->getCustomerAccountName(), ACCOUNTS_TO_IGNORE)) {
                    assert(
                        (string) "{$payment->getReference()} {$payment->getPenceAmount()} {$payment->getCustomerAccountName()}" //phpcs:ignore
                        . PHP_EOL
                    );
                }
            }
        }

        /*💬*/ echo '... Done.' . PHP_EOL;

        /*💬*/ echo 'Building customers... ';

        // Fetch customer DTOs
        $customerDTOs = (array) (new DataAccessService([
            new CustomerDataAdapterBUY((new ReadCSVService(BUY_CSV))->readRows()),
        ]))->fetchAllDTOs();

        // Instantiate customers from DTOs
        $customers = [];
        foreach ($customerDTOs as $customerDTO) {
            $customer = (new CustomerFactory(
                $customerDTO,
                $trades,
                []
            ))->build();
            array_push($customers, $customer);
        }

        /*💬*/ echo 'Done.' . PHP_EOL;

        /*💬*/ echo 'Checking trade assignment... ';

        // Check trades have been assigned to customers
        foreach ($customers as $customer) {
            assert(
                $customer->getFullName() . ": "
            );
            foreach ($customer->getTrades() as $trade) {
                assert(
                    $trade->getId() . " "
                );
            }
            assert(PHP_EOL);
        }

        /*💬*/ echo 'Done.' . PHP_EOL;

        /*💬*/ echo 'Calculating risk scores... ' . PHP_EOL;

        foreach ($customers as $customer) {
            $score = $customer->getAssessment('volume')->getRiskScore() / 100;
            if ($score > 5000) {
                echo(
                    "{$customer->getUsername('lbc')}: {$score}" . PHP_EOL
                );
            }
        }

        /*💬*/ echo 'Done.' . PHP_EOL;
