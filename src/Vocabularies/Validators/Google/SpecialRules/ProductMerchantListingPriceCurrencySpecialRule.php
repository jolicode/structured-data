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
 * A merchant listing offer may carry its price on the Offer itself or inside a
 * priceSpecification: "priceCurrency" is only required next to an Offer-level
 * "price" (the priceSpecification requires its own currency).
 *
 * @see https://developers.google.com/search/docs/appearance/structured-data/merchant-listing#offer-details
 *
 * @phpstan-import-type ValidationProperty from ValidationPropertiesNormalizer
 */
final class ProductMerchantListingPriceCurrencySpecialRule implements SpecialRuleInterface
{
    public static function getKey(): string
    {
        return 'google.product.merchant_listing_price_currency';
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
        if (!$this->hasType($type->getType(), 'Offer')) {
            return [];
        }

        if ('offers' !== $type->getParentProperty()?->getKey()) {
            return [];
        }

        $properties = $type->getProperties();

        if (!\array_key_exists('price', $properties) || \array_key_exists('priceCurrency', $properties)) {
            return [];
        }

        return [[
            'target' => $type,
            'message' => 'Missing required property: "priceCurrency" for the type "Offer" when "price" is specified.',
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
