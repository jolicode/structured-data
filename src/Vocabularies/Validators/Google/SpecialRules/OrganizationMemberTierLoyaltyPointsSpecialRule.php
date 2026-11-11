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

/**
 * A member tier earning loyalty points should say how many points members earn
 * per currency unit spent: "membershipPointsEarned" is recommended only when the
 * tier benefit is TierBenefitLoyaltyPoints.
 *
 * @see https://developers.google.com/search/docs/appearance/structured-data/loyalty-program#member-program-tier
 */
final class OrganizationMemberTierLoyaltyPointsSpecialRule implements SpecialRuleInterface
{
    private const LOYALTY_POINTS_ENUM_VALUES = [
        'TierBenefitLoyaltyPoints',
        'https://schema.org/TierBenefitLoyaltyPoints',
    ];

    public static function getKey(): string
    {
        return 'google.organization.member_tier_loyalty_points';
    }

    /**
     * @param array<string, mixed> $missingProperty
     */
    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    /**
     * @param array<string, mixed> $missingProperty
     */
    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function getTypeViolations(MappedType $type): array
    {
        if ('hasTiers' !== $type->getParentProperty()?->getKey() || !$this->hasType($type->getType(), 'MemberProgramTier')) {
            return [];
        }

        if (\array_key_exists('membershipPointsEarned', $type->getProperties())) {
            return [];
        }

        $benefits = array_filter((array) $type->getProperty('hasTierBenefit')?->getValue(), \is_string(...));

        if ([] === array_intersect($benefits, self::LOYALTY_POINTS_ENUM_VALUES)) {
            return [];
        }

        return [[
            'target' => $type,
            'message' => 'Missing recommended property: "membershipPointsEarned" for the type "MemberProgramTier" when "hasTierBenefit" is "TierBenefitLoyaltyPoints".',
            'severity' => MappedError::SEVERITY_WARNING,
        ]];
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
