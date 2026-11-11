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

use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Vocabularies\Validators\Google\ValidationPropertiesNormalizer;

/**
 * @phpstan-import-type ValidationProperty from ValidationPropertiesNormalizer
 */
final class DiscussionForumPostingContentOrUrlSpecialRule implements SpecialRuleInterface
{
    public static function getKey(): string
    {
        return 'google.discussion_forum.content_or_url';
    }

    /**
     * @param ValidationProperty $missingProperty
     */
    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        if ('atLeastOneOf' !== $missingProperty['name']) {
            return false;
        }

        if (!$this->hasType($type->getType(), 'DiscussionForumPosting') && !$this->hasType($type->getType(), 'SocialMediaPosting')) {
            return false;
        }

        $url = $type->getProperties()['url'] ?? null;

        return $url instanceof MappedProperty && null !== $url->getValue() && [] !== $url->getValue();
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
        return [];
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
