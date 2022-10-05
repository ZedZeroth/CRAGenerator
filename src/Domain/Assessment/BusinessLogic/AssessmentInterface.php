<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Assessment\BusinessLogic;

/**
 * The risk assessment interface
 */

interface AssessmentInterface
{
    public function getRiskScore(): int;
}
