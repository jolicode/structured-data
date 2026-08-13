<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Compact;

use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\TermDefinition\TermDefinition;

/**
 * Lookups the Compaction algorithm performs against the active context.
 */
final class TermLookup
{
    public static function getTermDefinition(Context $activeContext, ?string $term): ?TermDefinition
    {
        if (null === $term) {
            return null;
        }

        $definition = $activeContext->termDefinitions[$term] ?? null;

        return $definition instanceof TermDefinition ? $definition : null;
    }

    /**
     * @param array<string> $container
     */
    public static function getMapContainerKeyword(array $container): ?string
    {
        foreach ([Keyword::LANGUAGE->value, Keyword::INDEX->value, Keyword::ID->value, Keyword::TYPE->value] as $keyword) {
            if (\in_array($keyword, $container, true)) {
                return $keyword;
            }
        }

        return null;
    }

    public static function isSubjectReference(\stdClass $element): bool
    {
        $entries = get_object_vars($element);

        return 1 === \count($entries) && \array_key_exists(Keyword::ID->value, $entries);
    }
}
