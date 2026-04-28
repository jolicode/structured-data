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

use Jolicode\Vocabularies\Mapper\MappedError;
use Jolicode\Vocabularies\Mapper\MappedType;

final class OrganizationTaxIdCountryConsistencySpecialRule implements SpecialRuleInterface
{
    public static function getKey(): string
    {
        return 'google.organization.tax_id_country_consistency';
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
        if (!$this->hasType($type->type, 'Organization') && !$this->hasType($type->type, 'OnlineStore')) {
            return [];
        }

        $country = $this->extractAddressCountry($type);

        if (null === $country) {
            return [];
        }

        $violations = [];

        foreach (['taxID', 'vatID'] as $identifierProperty) {
            $identifier = $type->properties[$identifierProperty]->value ?? null;

            if (!\is_string($identifier)) {
                continue;
            }

            $prefix = $this->extractLeadingCountryPrefix($identifier);

            if (null === $prefix || $prefix === $country) {
                continue;
            }

            $violations[] = [
                'target' => $type->properties[$identifierProperty],
                'message' => \sprintf(
                    'Potential inconsistency: "%s" starts with "%s" but "address.addressCountry" is "%s". Ensure tax identifiers match the declared country.',
                    $identifierProperty,
                    $prefix,
                    $country,
                ),
                'severity' => MappedError::SEVERITY_WARNING,
            ];
        }

        return $violations;
    }

    private function extractAddressCountry(MappedType $type): ?string
    {
        $address = $type->properties['address']->value ?? null;

        if (!$address instanceof MappedType) {
            return null;
        }

        $country = $address->properties['addressCountry']->value ?? null;

        if (!\is_string($country)) {
            return null;
        }

        $country = strtoupper(trim($country));

        return preg_match('/^[A-Z]{2}$/', $country) ? $country : null;
    }

    private function extractLeadingCountryPrefix(string $identifier): ?string
    {
        if (!preg_match('/^\s*([A-Za-z]{2})(?=[0-9\-\s\.])/', $identifier, $matches)) {
            return null;
        }

        return strtoupper($matches[1]);
    }

    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }
}
