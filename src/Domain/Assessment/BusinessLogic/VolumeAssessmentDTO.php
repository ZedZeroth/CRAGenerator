<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Assessment\BusinessLogic;

/**
 * The volume risk assessment DTO
 */

final class VolumeAssessmentDTO
{
    public function __construct(
        public array $trades
    ) {
    }
}
