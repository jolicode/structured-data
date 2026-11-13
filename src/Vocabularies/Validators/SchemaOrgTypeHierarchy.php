<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Validators;

use JoliCode\StructuredData\Vocabularies\Generated\GeneratedClassesRegistry;

/**
 * The schema.org type hierarchy, as recorded by the generated vocabulary classes.
 */
final class SchemaOrgTypeHierarchy
{
    private const TYPE_NAMESPACE = 'JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\Type';

    /** @var array<string, list<string>> */
    private static array $selfAndAncestorsByType = [];

    /**
     * The type itself, then its ancestors, nearest first. Types at the same
     * distance come in alphabetical order, so a type with several supertypes
     * always resolves the same way. A type the vocabulary does not know has no
     * ancestor.
     *
     * @return list<string>
     */
    public static function selfAndAncestors(string $typeLabel): array
    {
        if (isset(self::$selfAndAncestorsByType[$typeLabel])) {
            return self::$selfAndAncestorsByType[$typeLabel];
        }

        $ordered = [$typeLabel];
        $seen = [$typeLabel => true];
        $level = [$typeLabel];

        while ([] !== $level) {
            $nextLevel = [];

            foreach ($level as $label) {
                foreach (self::parentsOf($label) as $parent) {
                    if (!isset($seen[$parent])) {
                        $seen[$parent] = true;
                        $nextLevel[] = $parent;
                    }
                }
            }

            sort($nextLevel);
            array_push($ordered, ...$nextLevel);
            $level = $nextLevel;
        }

        return self::$selfAndAncestorsByType[$typeLabel] = $ordered;
    }

    /**
     * Whether the type is, or descends from, one of the given types.
     *
     * @param list<string> $typeLabels
     */
    public static function isA(string $typeLabel, array $typeLabels): bool
    {
        return [] !== array_intersect(self::selfAndAncestors($typeLabel), $typeLabels);
    }

    /**
     * @return list<string>
     */
    private static function parentsOf(string $typeLabel): array
    {
        $class = \sprintf('%s\\%sModel', self::TYPE_NAMESPACE, $typeLabel);

        if (!GeneratedClassesRegistry::has($class) || !\defined($class . '::PARENTS')) {
            return [];
        }

        $parents = [];

        /** @var class-string $parentClass */
        foreach ($class::PARENTS as $parentClass) {
            if (\defined($parentClass . '::LABEL') && \is_string($parentClass::LABEL)) {
                $parents[] = $parentClass::LABEL;
            }
        }

        return $parents;
    }
}
