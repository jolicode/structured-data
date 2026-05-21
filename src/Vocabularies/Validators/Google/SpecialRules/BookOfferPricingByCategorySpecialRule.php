<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Validators\Google\SpecialRules;

use Jolicode\JsonLd\Mapper\MappedError;
use Jolicode\JsonLd\Mapper\MappedType;

final class BookOfferPricingByCategorySpecialRule implements SpecialRuleInterface
{
    private const PURCHASE_CATEGORIES = ['purchase', 'rental'];

    public static function getKey(): string
    {
        return 'google.book.offer_pricing_by_category';
    }

    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        if (!$this->isReadActionOffer($type)) {
            return false;
        }

        $missingPropertyName = $missingProperty['name'] ?? '';

        if (!\in_array($missingPropertyName, ['price', 'priceCurrency'], true)) {
            return false;
        }

        $category = $this->getCategoryValue($type);

        if (null === $category) {
            return false;
        }

        if ('price' === $missingPropertyName) {
            // price is handled by a dedicated conditional rule below.
            return true;
        }

        return !\in_array($category, self::PURCHASE_CATEGORIES, true);
    }

    public function getTypeViolations(MappedType $type): array
    {
        if (!$this->isReadActionOffer($type)) {
            return [];
        }

        $category = $this->getCategoryValue($type);

        if (null === $category || !\in_array($category, self::PURCHASE_CATEGORIES, true)) {
            return [];
        }

        if (\array_key_exists('price', $type->getProperties())) {
            return [];
        }

        return [[
            'target' => $type,
            'message' => 'Missing required property: "price" for the type "Offer" when "category" is "purchase" or "rental".',
            'severity' => MappedError::SEVERITY_ERROR,
        ]];
    }

    private function isReadActionOffer(MappedType $type): bool
    {
        if (!$this->hasType($type->getType(), 'Offer')) {
            return false;
        }

        if ('expectsAcceptanceOf' !== $type->getParentProperty()?->getKey()) {
            return false;
        }

        return $this->hasBookInAncestors($type);
    }

    private function getCategoryValue(MappedType $type): ?string
    {
        $value = $type->getProperty('category')?->getValue();

        if (!\is_string($value)) {
            return null;
        }

        return strtolower($value);
    }

    private function hasBookInAncestors(MappedType $type): bool
    {
        while ($type) {
            if ($this->hasType($type->getType(), 'Book')) {
                return true;
            }

            $type = $type->getParent();
        }

        return false;
    }

    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }
}
