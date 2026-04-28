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

use Jolicode\Vocabularies\Mapper\MappedProperty;
use Jolicode\Vocabularies\Mapper\MappedType;

final class DiscussionForumPostingContentOrUrlSpecialRule implements SpecialRuleInterface
{
    public static function getKey(): string
    {
        return 'google.discussion_forum.content_or_url';
    }

    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        if ('atLeastOneOf' !== ($missingProperty['name'] ?? null)) {
            return false;
        }

        if (!$this->hasType($type->type, 'DiscussionForumPosting') && !$this->hasType($type->type, 'SocialMediaPosting')) {
            return false;
        }

        $url = $type->properties['url'] ?? null;

        return $url instanceof MappedProperty && null !== $url->value && [] !== $url->value;
    }

    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function getTypeViolations(MappedType $type): array
    {
        return [];
    }

    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }
}
