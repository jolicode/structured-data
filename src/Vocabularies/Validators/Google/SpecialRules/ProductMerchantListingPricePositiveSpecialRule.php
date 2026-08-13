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

final class ProductMerchantListingPricePositiveSpecialRule implements SpecialRuleInterface
{
    public static function getKey(): string
    {
        return 'google.product.merchant_listing_price_positive';
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
        if (!$this->isMerchantListingOffer($type)) {
            return [];
        }

        $price = $type->getProperty('price')?->getValue();

        if (!is_numeric($price)) {
            return [];
        }

        if ((float) $price > 0) {
            return [];
        }

        return [[
            'target' => $type->getProperties()['price'],
            'message' => 'Invalid value: "price" must be greater than 0 for merchant listing offers.',
            'severity' => MappedError::SEVERITY_ERROR,
        ]];
    }

    private function isMerchantListingOffer(MappedType $type): bool
    {
        if (!$this->hasType($type->getType(), 'Offer')) {
            return false;
        }

        if ('offers' !== $type->getParentProperty()?->getKey()) {
            return false;
        }

        return $this->hasType($this->getRootType($type)->getType(), 'Product');
    }

    private function getRootType(MappedType $type): MappedType
    {
        while ($type->getParent()) {
            $type = $type->getParent();
        }

        return $type;
    }

    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }
}
