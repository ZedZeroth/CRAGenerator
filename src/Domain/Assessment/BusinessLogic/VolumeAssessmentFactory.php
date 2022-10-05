<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Assessment\BusinessLogic;

/**
 * Instantiates a volume risk assessment from its DTO
 */

final class VolumeAssessmentFactory
{
    public function __construct(
        // The assessment's properties are built from the DTO
        private object $dto
    ) {
    }

    public function build(): VolumeAssessment
    {
        $riskScore = $this->calculate();
        return
            new VolumeAssessment(
                (int) $riskScore
            );
    }

    public function calculate(): int
    {
        $total = 0;
        foreach ($this->dto->trades as $trade) {
            $total += $trade->getPenceAmount();
        }
        return $total;
    }
}
