<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Validators\Google\SpecialRules;

use JoliCode\StructuredData\Mapper\MappedError;
use JoliCode\StructuredData\Mapper\MappedType;

final class JobPostingRemoteJobLocationRequirementsSpecialRule implements SpecialRuleInterface
{
    public static function getKey(): string
    {
        return 'google.job_posting.remote_job_location_requirements';
    }

    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        if ('jobLocation' !== ($missingProperty['name'] ?? null)) {
            return false;
        }

        if (!$this->hasType($type->getType(), 'JobPosting')) {
            return false;
        }

        return $this->isTelecommute($type);
    }

    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function getTypeViolations(MappedType $type): array
    {
        if (!$this->hasType($type->getType(), 'JobPosting')) {
            return [];
        }

        if (!$this->isTelecommute($type)) {
            return [];
        }

        if (\array_key_exists('jobLocation', $type->getProperties())) {
            return [];
        }

        if (\array_key_exists('applicantLocationRequirements', $type->getProperties())) {
            return [];
        }

        return [[
            'target' => $type,
            'message' => 'Missing required property: "applicantLocationRequirements" for the type "JobPosting" when "jobLocationType" is "TELECOMMUTE" and no "jobLocation" is provided.',
            'severity' => MappedError::SEVERITY_ERROR,
        ]];
    }

    private function isTelecommute(MappedType $type): bool
    {
        $jobLocationType = $type->getProperty('jobLocationType')?->getValue();

        return 'TELECOMMUTE' === $jobLocationType;
    }

    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }
}
