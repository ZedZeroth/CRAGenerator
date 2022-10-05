<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Assessment\BusinessLogic;

/**
 * The volume risk assessment model
 */

final class VolumeAssessment implements AssessmentInterface
{
    public function __construct(
        private int $riskScore
    ) {
    }

    /* Getters */

    public function getRiskScore(): int
    {
        return $this->riskScore;
    }
}
