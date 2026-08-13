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

final class OrganizationReturnPolicyMerchantReturnDaysWhenFiniteSpecialRule implements SpecialRuleInterface
{
    private const FINITE_RETURN_ENUM_VALUES = [
        'MerchantReturnFiniteReturnWindow',
        'https://schema.org/MerchantReturnFiniteReturnWindow',
    ];

    public static function getKey(): string
    {
        return 'google.organization.return_policy_merchant_return_days_when_finite';
    }

    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function getTypeViolations(MappedType $type): array
    {
        if (!$this->hasType($type->getType(), 'MerchantReturnPolicy')) {
            return [];
        }

        if ('hasMerchantReturnPolicy' !== $type->getParentProperty()?->getKey()) {
            return [];
        }

        $returnPolicyCategory = $type->getProperty('returnPolicyCategory')?->getValue();

        if (!\in_array($returnPolicyCategory, self::FINITE_RETURN_ENUM_VALUES, true)) {
            return [];
        }

        if (\array_key_exists('merchantReturnDays', $type->getProperties())) {
            return [];
        }

        return [[
            'target' => $type,
            'message' => 'Missing required property: "merchantReturnDays" for the type "MerchantReturnPolicy" when "returnPolicyCategory" is "MerchantReturnFiniteReturnWindow".',
            'severity' => MappedError::SEVERITY_ERROR,
        ]];
    }

    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }
}
