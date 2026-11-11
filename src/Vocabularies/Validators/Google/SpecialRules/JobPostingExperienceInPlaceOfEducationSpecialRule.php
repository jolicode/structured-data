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
use JoliCode\StructuredData\Vocabularies\Validators\Google\ValidationPropertiesNormalizer;

/**
 * Accepting experience in place of education only makes sense when both are
 * described: "experienceInPlaceOfEducation" set to true requires the
 * "educationRequirements" and "experienceRequirements" properties.
 *
 * @see https://developers.google.com/search/docs/appearance/structured-data/job-posting#education-and-experience-properties-beta
 *
 * @phpstan-import-type ValidationProperty from ValidationPropertiesNormalizer
 */
final class JobPostingExperienceInPlaceOfEducationSpecialRule implements SpecialRuleInterface
{
    private const REQUIRED_PROPERTIES = [
        'educationRequirements',
        'experienceRequirements',
    ];

    public static function getKey(): string
    {
        return 'google.job_posting.experience_in_place_of_education';
    }

    /**
     * @param ValidationProperty $missingProperty
     */
    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    /**
     * @param ValidationProperty $missingProperty
     */
    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function getTypeViolations(MappedType $type): array
    {
        if (null !== $type->getParentProperty() || !$this->hasType($type->getType(), 'JobPosting')) {
            return [];
        }

        $experienceInPlaceOfEducation = $type->getProperty('experienceInPlaceOfEducation')?->getValue();

        if (true !== $experienceInPlaceOfEducation && 'true' !== (\is_string($experienceInPlaceOfEducation) ? strtolower(trim($experienceInPlaceOfEducation)) : null)) {
            return [];
        }

        $violations = [];

        foreach (self::REQUIRED_PROPERTIES as $requiredProperty) {
            if (!\array_key_exists($requiredProperty, $type->getProperties())) {
                $violations[] = [
                    'target' => $type,
                    'message' => \sprintf('Missing required property: "%s" for the type "JobPosting" when "experienceInPlaceOfEducation" is true.', $requiredProperty),
                    'severity' => MappedError::SEVERITY_ERROR,
                ];
            }
        }

        return $violations;
    }

    /**
     * @param string|array<string>|null $type
     */
    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }
}
