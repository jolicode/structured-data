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

use Jolicode\JsonLd\Mapper\MappedProperty;
use Jolicode\JsonLd\Mapper\MappedType;

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

        if ('author' !== $type->getParentProperty()?->getKey()) {
            return false;
        }

        if (!$this->hasType($type->getType(), 'Person') && !$this->hasType($type->getType(), 'Organization')) {
            return false;
        }

        if (!$this->isInsideArticleType($type)) {
            return false;
        }

        $sameAs = $type->getProperties()['sameAs'] ?? null;

        return $sameAs instanceof MappedProperty && null !== $sameAs->getValue() && [] !== $sameAs->getValue();
    }

    public function getTypeViolations(MappedType $type): array
    {
        return [];
    }

    private function isInsideArticleType(MappedType $type): bool
    {
        while ($type->getParent()) {
            $type = $type->getParent();
        }

        if (\is_array($type->getType())) {
            return \count(array_intersect(['Article', 'NewsArticle', 'BlogPosting'], $type->getType())) > 0;
        }

        return \in_array($type->getType(), ['Article', 'NewsArticle', 'BlogPosting'], true);
    }

    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }
}
