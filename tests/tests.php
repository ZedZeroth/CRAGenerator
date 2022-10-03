<?php declare(strict_types=1);

use CRAGenerator\Domain\Trade\Testing\TradeTestService;
use CRAGenerator\Domain\Customer\Testing\CustomerTestService;

try {

    // Trade tests
    $test = (new TradeTestService())->test();

    // Customer tests
    $test = (new CustomerTestService())->test();

} catch (Exception $e) {
    echo($e);
}