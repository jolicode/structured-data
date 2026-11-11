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
 * The requirements of an organization-level return policy that depend on other
 * properties of the policy:
 * - a return policy category must come with the country it applies to;
 * - a finite return window requires "merchantReturnDays", seasonal overrides included;
 * - return shipping fees require the matching shipping fees amount;
 * - the return details are recommended only when returns are accepted, that is
 *   for a finite or an unlimited return window.
 *
 * @see https://developers.google.com/search/docs/appearance/structured-data/return-policy
 */
final class OrganizationReturnPolicySpecialRule implements SpecialRuleInterface
{
    private const FINITE_RETURN_ENUM_VALUES = [
        'MerchantReturnFiniteReturnWindow',
        'https://schema.org/MerchantReturnFiniteReturnWindow',
    ];

    private const RETURNS_ACCEPTED_ENUM_VALUES = [
        'MerchantReturnFiniteReturnWindow',
        'https://schema.org/MerchantReturnFiniteReturnWindow',
        'MerchantReturnUnlimitedWindow',
        'https://schema.org/MerchantReturnUnlimitedWindow',
    ];

    private const RETURN_SHIPPING_FEES_ENUM_VALUES = [
        'ReturnShippingFees',
        'https://schema.org/ReturnShippingFees',
    ];

    /**
     * Each fee property, and the amount it requires when the consumer pays the return shipping.
     */
    private const SHIPPING_FEES_AMOUNTS = [
        'returnFees' => 'returnShippingFeesAmount',
        'customerRemorseReturnFees' => 'customerRemorseReturnShippingFeesAmount',
        'itemDefectReturnFees' => 'itemDefectReturnShippingFeesAmount',
    ];

    private const RECOMMENDED_WHEN_RETURNS_ACCEPTED = [
        'returnFees',
        'returnMethod',
        'customerRemorseReturnFees',
        'customerRemorseReturnLabelSource',
        'itemCondition',
        'itemDefectReturnFees',
        'itemDefectReturnLabelSource',
        'refundType',
        'restockingFee',
        'returnLabelSource',
        'returnPolicyCountry',
    ];

    public static function getKey(): string
    {
        return 'google.organization.return_policy';
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
        $parentKey = $type->getParentProperty()?->getKey();

        if ('returnPolicySeasonalOverride' === $parentKey && $this->hasType($type->getType(), 'MerchantReturnPolicySeasonalOverride')) {
            return $this->getMerchantReturnDaysViolations($type, 'MerchantReturnPolicySeasonalOverride');
        }

        if ('hasMerchantReturnPolicy' !== $parentKey || !$this->hasType($type->getType(), 'MerchantReturnPolicy')) {
            return [];
        }

        $properties = $type->getProperties();
        $violations = $this->getMerchantReturnDaysViolations($type, 'MerchantReturnPolicy');

        if (\array_key_exists('returnPolicyCategory', $properties) && !\array_key_exists('applicableCountry', $properties)) {
            $violations[] = [
                'target' => $type,
                'message' => 'Missing required property: "applicableCountry" for the type "MerchantReturnPolicy" when "returnPolicyCategory" is specified.',
                'severity' => MappedError::SEVERITY_ERROR,
            ];
        }

        foreach (self::SHIPPING_FEES_AMOUNTS as $feesProperty => $amountProperty) {
            if (
                \in_array($type->getProperty($feesProperty)?->getValue(), self::RETURN_SHIPPING_FEES_ENUM_VALUES, true)
                && !\array_key_exists($amountProperty, $properties)
            ) {
                $violations[] = [
                    'target' => $type,
                    'message' => \sprintf('Missing required property: "%s" for the type "MerchantReturnPolicy" when "%s" is "ReturnShippingFees".', $amountProperty, $feesProperty),
                    'severity' => MappedError::SEVERITY_ERROR,
                ];
            }
        }

        if (!\in_array($type->getProperty('returnPolicyCategory')?->getValue(), self::RETURNS_ACCEPTED_ENUM_VALUES, true)) {
            return $violations;
        }

        foreach (self::RECOMMENDED_WHEN_RETURNS_ACCEPTED as $recommendedProperty) {
            if (!\array_key_exists($recommendedProperty, $properties)) {
                $violations[] = [
                    'target' => $type,
                    'message' => \sprintf('Missing recommended property: "%s" for the type "MerchantReturnPolicy" when returns are accepted.', $recommendedProperty),
                    'severity' => MappedError::SEVERITY_WARNING,
                ];
            }
        }

        return $violations;
    }

    /**
     * @return array<int, array{target: MappedType, message: string, severity: string}>
     */
    private function getMerchantReturnDaysViolations(MappedType $type, string $typeName): array
    {
        if (
            !\in_array($type->getProperty('returnPolicyCategory')?->getValue(), self::FINITE_RETURN_ENUM_VALUES, true)
            || \array_key_exists('merchantReturnDays', $type->getProperties())
        ) {
            return [];
        }

        return [[
            'target' => $type,
            'message' => \sprintf('Missing required property: "merchantReturnDays" for the type "%s" when "returnPolicyCategory" is "MerchantReturnFiniteReturnWindow".', $typeName),
            'severity' => MappedError::SEVERITY_ERROR,
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
