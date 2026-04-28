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

final class ArticleAuthorUrlOrSameAsSpecialRule implements SpecialRuleInterface
{
    public static function getKey(): string
    {
        return 'google.article.author_url_or_sameas';
    }

    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        if ('url' !== ($missingProperty['name'] ?? null)) {
            return false;
        }

        if ('author' !== $type->parentProperty?->key) {
            return false;
        }

        if (!$this->hasType($type->type, 'Person') && !$this->hasType($type->type, 'Organization')) {
            return false;
        }

        if (!$this->isInsideArticleType($type)) {
            return false;
        }

        $sameAs = $type->properties['sameAs'] ?? null;

        return $sameAs instanceof MappedProperty && null !== $sameAs->value && [] !== $sameAs->value;
    }

    public function getTypeViolations(MappedType $type): array
    {
        return [];
    }

    private function isInsideArticleType(MappedType $type): bool
    {
        while ($type->parent) {
            $type = $type->parent;
        }

        if (\is_array($type->type)) {
            return \count(array_intersect(['Article', 'NewsArticle', 'BlogPosting'], $type->type)) > 0;
        }

        return \in_array($type->type, ['Article', 'NewsArticle', 'BlogPosting'], true);
    }

    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }
}
