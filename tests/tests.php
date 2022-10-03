<?php declare(strict_types=1);

// Trade tests
use CRAGenerator\Domain\Trade\Testing\TradeTestService;
$test = (new TradeTestService())->test();

// Customer tests
use CRAGenerator\Domain\Customer\Testing\CustomerTestService;
$test = (new CustomerTestService())->test();
