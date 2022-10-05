<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Trade\BusinessLogic;

use CRAGenerator\Domain\Payment\BusinessLogic\Payment;

/**
 * Fetches a specified trade's payment(s)
 */

final class AssignPaymentsService
{
    public function __construct(
        private Trade $trade,
        private array $allPayments
    ) {
    }

    private function isMatchingReference(Payment $payment): bool
    {
        /* Deal with LBC-specific matching */
        if ($this->trade->getPlatform() == 'lbc') {
            if (
                substr($payment->getReference(), 0, 8) ==
                substr($this->trade->getId(), 0, 8)
            ) {
                return true;
            }
        /* Otherwise look for identical match */
        } else {
            if (
                $payment->getReference() ==
                $this->trade->getId()
            ) {
                return true;
            }
        }
        return false;
    }

    private function isMatchingPenceAmount(Payment $payment): bool
    {
        if (
            $payment->getPenceAmount() ==
            $this->trade->getPenceAmount()
        ) {
            return true;
        } else {
            return false;
        }
    }

    private function manuallyApproveAmountMismatch(Payment $payment): ?Payment
    {
        echo(PHP_EOL);
        echo("Trade {$this->trade->getId()}: {$this->trade->getPenceAmount()}p {$this->trade->getUsername()}"); //phpcs:ignore
        echo(PHP_EOL);
        echo("Pymnt {$payment->getReference()}: {$payment->getPenceAmount()}p {$payment->getCustomerAccountName()} ... {$payment->getId()}"); //phpcs:ignore
        echo(PHP_EOL);

        /* Manually approve amount mismatches */
        $userInput = '';
        $userInput = readLine('Match? (y/n) ');
        if ($userInput == 'y') {
            if ($payment->isAssigned()) {
                echo("Assigning Payment {$payment->getReference()} to Trade {$this->trade->getId()}. This payment was already assigned!" . PHP_EOL); //phpcs:ignore
            }
            $payment->setAssigned(true);
            return $payment;
        }
        return null;
    }

    public function assign(): ?Payment
    {
        foreach ($this->allPayments as $payment) {
            if ($this->isMatchingReference($payment)) {
                if ($this->isMatchingPenceAmount($payment)) {

                    if ($payment->isAssigned()) {
                        echo("Assigning Payment {$payment->getReference()} to Trade {$this->trade->getId()}. This payment was already assigned!" . PHP_EOL); //phpcs:ignore
                    }
                    $payment->setAssigned(true);
                    return $payment;
                } else {
                    $this->manuallyApproveAmountMismatch($payment);
                }
            }
        }
        return null;
    }
}
