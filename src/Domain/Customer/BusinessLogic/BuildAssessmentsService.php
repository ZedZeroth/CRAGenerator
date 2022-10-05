<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\BusinessLogic;

use CRAGenerator\Domain\Assessment\BusinessLogic\VolumeAssessmentDTO;
use CRAGenerator\Domain\Assessment\BusinessLogic\VolumeAssessmentFactory;

/**
 * Builds a specified customer's risk assessments
 */

final class BuildAssessmentsService
{
    public function __construct(
        private Customer $customer
    ) {
    }

    public function buildEachAssessment(): Customer /* Chainable */
    {
        /* Assess all 11 risk categories */
        $this
            ->assessVolume() /* Based on trades */
            //->assessVelocity() /* Based on trades */
            //->assessPlatforms() /* Based on trades */
            //->assessSourceOfFunds() /* Based on customer data */
            //->assessDestinationOfFunds() /* Based on customer data */
            //->assessBankAccounts() /* Based on customer data */
            //->assessBankVolume() /* Based on customer data */
            //->assessLocations() /* Based on customer data */
            //->assessAge() /* Based on customer data */
            //->assessPep() /* Based on customer data */
            //->assessMisc() /* Based on customer data */
            ;
        return $this->customer;
    }

    private function assessVolume(): BuildAssessmentsService /* Chainable */
    {
        /* Sets the customer's volume assessment */
        $this->customer->setAssessment(
            'volume',
            (new VolumeAssessmentFactory(
                /* Create volume assessment DTO */
                new VolumeAssessmentDTO(
                    $this->customer->getTrades()
                )
            ))->build()
        );
        return $this;
    }
}
