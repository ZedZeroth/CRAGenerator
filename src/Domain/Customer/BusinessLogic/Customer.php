<?php

declare(strict_types=1);

namespace CRAGenerator\Domain\Customer\BusinessLogic;

use CRAGenerator\Domain\Assessment\BusinessLogic\AssessmentInterface;

/**
 * The customer model
 */

final class Customer
{
    public function __construct(
        /* Dependencies */
        private array $trades,
        private array $assessments,
        /* Identity */
        private string $familyName,
        private string $givenName,
        /* Platforms */
        /* An associative array of this customer's usernames on different platforms */
        private array $usernames
    ) {
    }

    public function assignTrades(array $allTrades): Customer
    {
        $this->trades = (new AssignTradesService($this, $allTrades))->fetch();
        return $this;
    }

    public function calculateRisks(): Customer
    {
        return (new BuildAssessmentsService($this))->buildEachAssessment();
    }

    /* Setters */

    public function setAssessment(string $assessmentName, AssessmentInterface $assessment): void
    {
        $this->assessments[$assessmentName] = $assessment;
    }

    /* Getters */

    public function getUsername(string $platform): ?string
    {
        if (array_key_exists($platform, $this->usernames)) {
            return $this->usernames[$platform];
        }
        return null;
    }

    public function getFullName(): string
    {
        return "{$this->familyName}, {$this->givenName}";
    }

    public function getTrades(): array
    {
        return $this->trades;
    }

    public function getAssessment(string $assessmentName): AssessmentInterface
    {
        return $this->assessments[$assessmentName];
    }
}
