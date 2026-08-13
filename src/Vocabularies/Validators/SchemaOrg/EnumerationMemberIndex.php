<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Validators\SchemaOrg;

use JoliCode\StructuredData\Vocabularies\Generated\GeneratedClassesRegistry;

/**
 * Resolves which generated enumeration members a schema.org property accepts.
 *
 * Returns decisions only: reporting the error stays with the validator.
 */
final class EnumerationMemberIndex
{
    private const SCHEMA_ORG_DOMAIN = 'http://schema.org/';
    private const SCHEMA_ORG_DOMAIN_SECURE = 'https://schema.org/';

    private const GENERATED_ENUMERATION_MEMBER_NAMESPACE = 'JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\EnumerationMember';

    /**
     * @var array<string, string>|null
     */
    private static ?array $knownEnumerationMembersByLowercase = null;

    /**
     * @return array<string>
     */
    public static function getExpectedEnumerationTypeFqcns(string $propertyFqcn): array
    {
        $enumerationTypeFqcns = [];

        foreach ($propertyFqcn::VALUES as $expectedValueTypeFqcn) {
            if (!GeneratedClassesRegistry::has($expectedValueTypeFqcn)) {
                continue;
            }

            if (!\defined($expectedValueTypeFqcn . '::PARENTS') || !\defined($expectedValueTypeFqcn . '::ENUMERATION_MEMBERS')) {
                continue;
            }

            if (!\in_array('JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\Type\\EnumerationModel', $expectedValueTypeFqcn::PARENTS, true)) {
                continue;
            }

            $enumerationTypeFqcns[] = $expectedValueTypeFqcn;
        }

        return $enumerationTypeFqcns;
    }

    /**
     * @param array<string> $enumerationTypeFqcns
     */
    public static function isExpectedEnumerationMemberIri(string $value, array $enumerationTypeFqcns): ?bool
    {
        $label = str_replace([self::SCHEMA_ORG_DOMAIN, self::SCHEMA_ORG_DOMAIN_SECURE], '', $value);
        $labelLowercase = strtolower($label);

        foreach ($enumerationTypeFqcns as $enumerationTypeFqcn) {
            foreach ($enumerationTypeFqcn::ENUMERATION_MEMBERS as $memberClass) {
                $memberFqcn = self::resolveEnumerationMemberFqcn($memberClass);

                if (!GeneratedClassesRegistry::has($memberFqcn)) {
                    continue;
                }

                if (strtolower($memberFqcn::LABEL) === $labelLowercase) {
                    return true;
                }
            }
        }

        if (!isset(self::getKnownEnumerationMembersByLowercase()[$labelLowercase])) {
            // Unknown schema.org term (potentially from a newer schema.org release): ignore it.
            return null;
        }

        return false;
    }

    public static function isSchemaOrgIri(string $value): bool
    {
        return str_starts_with($value, self::SCHEMA_ORG_DOMAIN)
            || str_starts_with($value, self::SCHEMA_ORG_DOMAIN_SECURE);
    }

    private static function resolveEnumerationMemberFqcn(string $memberClass): string
    {
        if (str_starts_with($memberClass, 'JoliCode\\StructuredData\\')) {
            return $memberClass;
        }

        return \sprintf('JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\%s', $memberClass);
    }

    /**
     * @return array<string, string>
     */
    private static function getKnownEnumerationMembersByLowercase(): array
    {
        if (null !== self::$knownEnumerationMembersByLowercase) {
            return self::$knownEnumerationMembersByLowercase;
        }

        self::$knownEnumerationMembersByLowercase = [];

        foreach (GeneratedClassesRegistry::getShortNamesByPrefix(self::GENERATED_ENUMERATION_MEMBER_NAMESPACE) as $shortName) {
            $typeName = str_replace('Model', '', $shortName);
            self::$knownEnumerationMembersByLowercase[strtolower($typeName)] = $typeName;
        }

        return self::$knownEnumerationMembersByLowercase;
    }
}
