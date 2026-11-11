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
 * Some properties of a merchant listing return policy depend on another one:
 * "merchantReturnDays" is required for a finite return window,
 * "returnShippingFeesAmount" is required when the merchant charges the return
 * shipping (and must be left out otherwise), and "returnMethod" is recommended
 * only when returns are accepted.
 *
 * @see https://developers.google.com/search/docs/appearance/structured-data/merchant-listing#returns
 */
final class ProductMerchantListingReturnPolicySpecialRule implements SpecialRuleInterface
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

    public static function getKey(): string
    {
        return 'google.product.merchant_listing_return_policy';
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
        if (!$this->hasType($type->getType(), 'MerchantReturnPolicy')) {
            return [];
        }

        if ('hasMerchantReturnPolicy' !== $type->getParentProperty()?->getKey()) {
            return [];
        }

        $properties = $type->getProperties();
        $violations = [];

        if (
            \in_array($type->getProperty('returnPolicyCategory')?->getValue(), self::FINITE_RETURN_ENUM_VALUES, true)
            && !\array_key_exists('merchantReturnDays', $properties)
        ) {
            $violations[] = [
                'target' => $type,
                'message' => 'Missing required property: "merchantReturnDays" for the type "MerchantReturnPolicy" when "returnPolicyCategory" is "MerchantReturnFiniteReturnWindow".',
                'severity' => MappedError::SEVERITY_ERROR,
            ];
        }

        if (
            \in_array($type->getProperty('returnFees')?->getValue(), self::RETURN_SHIPPING_FEES_ENUM_VALUES, true)
            && !\array_key_exists('returnShippingFeesAmount', $properties)
        ) {
            $violations[] = [
                'target' => $type,
                'message' => 'Missing required property: "returnShippingFeesAmount" for the type "MerchantReturnPolicy" when "returnFees" is "ReturnShippingFees".',
                'severity' => MappedError::SEVERITY_ERROR,
            ];
        }

        if (
            \in_array($type->getProperty('returnPolicyCategory')?->getValue(), self::RETURNS_ACCEPTED_ENUM_VALUES, true)
            && !\array_key_exists('returnMethod', $properties)
        ) {
            $violations[] = [
                'target' => $type,
                'message' => 'Missing recommended property: "returnMethod" for the type "MerchantReturnPolicy" when returns are accepted.',
                'severity' => MappedError::SEVERITY_WARNING,
            ];
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
