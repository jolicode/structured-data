<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Frame;

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\FramingKeyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;

/**
 * Frame matching: decides whether a subject matches a frame, by explicit "@id"
 * or "@type" inclusion, or by duck typing on the frame properties.
 *
 * The subject map of the current graph is passed in rather than held, so that the
 * traversal state stays in Framer.
 *
 * @see https://www.w3.org/TR/json-ld11-framing/#framing-algorithm
 */
final class FrameMatcher
{
    /**
     * Returns true if the given subject matches the given frame: either on an
     * explicit "@id" or "@type" inclusion, or by duck typing on the frame
     * properties.
     *
     * @param array<string, mixed>                $subject
     * @param array<string, mixed>                $frame
     * @param array<string, mixed>                $flags
     * @param array<string, array<string, mixed>> $subjects
     */
    public static function matchesSubject(array $subject, array $frame, array $flags, array $subjects): bool
    {
        $wildcard = true;
        $matchesSome = false;

        foreach ($frame as $key => $frameValues) {
            $matchThis = false;
            $nodeValues = self::getValues($subject, (string) $key);
            $isEmpty = [] === (array) $frameValues;

            if (Keyword::ID->value === $key) {
                $frameIds = (array) $frameValues;

                if (self::isEmptyMap($frameIds[0] ?? null)) {
                    $matchThis = true;
                } else {
                    $matchThis = \in_array($nodeValues[0] ?? null, $frameIds, true);
                }

                if (!$flags['requireAll']) {
                    return $matchThis;
                }
            } elseif (Keyword::TYPE->value === $key) {
                $wildcard = false;
                $frameTypes = (array) $frameValues;

                if ($isEmpty) {
                    if (\count($nodeValues) > 0) {
                        return false;
                    }

                    $matchThis = true;
                } elseif (1 === \count($frameTypes) && self::isEmptyMap($frameTypes[0])) {
                    $matchThis = \count($nodeValues) > 0;
                } else {
                    foreach ($frameTypes as $type) {
                        if (\is_array($type) && \array_key_exists('@default', $type)) {
                            $matchThis = true;
                        } else {
                            $matchThis = $matchThis || \in_array($type, $nodeValues, true);
                        }
                    }
                }

                if (!$flags['requireAll']) {
                    return $matchThis;
                }
            } elseif (self::isKeywordString((string) $key)) {
                continue;
            } else {
                $thisFrame = ((array) $frameValues)[0] ?? null;
                $hasDefault = false;

                if (null !== $thisFrame) {
                    self::validateFrame([$thisFrame]);
                    $hasDefault = \is_array($thisFrame) && \array_key_exists('@default', $thisFrame);
                }

                // No longer a wildcard pattern once the frame has any non-keyword property.
                $wildcard = false;

                // A node without a value matches when the frame provides a default.
                if ([] === $nodeValues && $hasDefault) {
                    continue;
                }

                // A match-none frame value forbids any node value.
                if (\count($nodeValues) > 0 && $isEmpty) {
                    return false;
                }

                if (null === $thisFrame) {
                    $matchThis = [] === $nodeValues;
                } elseif (\is_array($thisFrame) && \array_key_exists(Keyword::LIST->value, $thisFrame)) {
                    $listValue = $thisFrame[Keyword::LIST->value][0] ?? null;
                    $nodeList = $nodeValues[0][Keyword::LIST->value] ?? null;

                    if (\is_array($listValue) && \is_array($nodeList)) {
                        if (\array_key_exists(Keyword::VALUE->value, $listValue)) {
                            foreach ($nodeList as $listItem) {
                                if (self::valueMatch($listValue, $listItem)) {
                                    $matchThis = true;

                                    break;
                                }
                            }
                        } else {
                            foreach ($nodeList as $listItem) {
                                if (self::nodeMatch($listValue, $listItem, $flags, $subjects)) {
                                    $matchThis = true;

                                    break;
                                }
                            }
                        }
                    }
                } elseif (\is_array($thisFrame) && \array_key_exists(Keyword::VALUE->value, $thisFrame)) {
                    foreach ($nodeValues as $nodeValue) {
                        if (self::valueMatch($thisFrame, $nodeValue)) {
                            $matchThis = true;

                            break;
                        }
                    }
                } elseif (self::isSubjectReference($thisFrame)) {
                    foreach ($nodeValues as $nodeValue) {
                        if (self::nodeMatch($thisFrame, $nodeValue, $flags, $subjects)) {
                            $matchThis = true;

                            break;
                        }
                    }
                } elseif (\is_array($thisFrame) || self::isEmptyMap($thisFrame)) {
                    $matchThis = \count($nodeValues) > 0;
                }
            }

            if (!$matchThis && $flags['requireAll']) {
                return false;
            }

            $matchesSome = $matchesSome || $matchThis;
        }

        return $wildcard || $matchesSome;
    }

    /**
     * A value object matches the value pattern when the pattern is empty, or when
     * its "@value", "@type" and "@language" entries all match (an empty map is a
     * wildcard, an empty array matches only a missing entry).
     */
    public static function valueMatch(mixed $pattern, mixed $value): bool
    {
        if (!\is_array($value) || !\array_key_exists(Keyword::VALUE->value, $value)) {
            return false;
        }

        // A wildcard pattern matches any value object.
        if (self::isEmptyMap($pattern)) {
            return true;
        }

        if (!\is_array($pattern)) {
            return false;
        }

        $v1 = $value[Keyword::VALUE->value];
        $t1 = $value[Keyword::TYPE->value] ?? null;
        $l1 = $value[Keyword::LANGUAGE->value] ?? null;

        $v2 = self::patternValues($pattern, Keyword::VALUE->value);
        $t2 = self::patternValues($pattern, Keyword::TYPE->value);
        $l2 = self::patternValues($pattern, Keyword::LANGUAGE->value);

        if ([] === $v2 && [] === $t2 && [] === $l2) {
            return true;
        }

        if (!(\in_array($v1, $v2, true) || self::isEmptyMap($v2[0] ?? null))) {
            return false;
        }

        if (!((null === $t1 && [] === $t2) || \in_array($t1, $t2, true) || (null !== $t1 && self::isEmptyMap($t2[0] ?? null)))) {
            return false;
        }

        return (null === $l1 && [] === $l2) || \in_array($l1, $l2, true) || (null !== $l1 && self::isEmptyMap($l2[0] ?? null));
    }

    /**
     * @param array<string, mixed> $flags
     *
     * @return array<int, array<string, mixed>>
     */
    public static function createImplicitFrame(array $flags): array
    {
        $frame = [];

        foreach ($flags as $name => $value) {
            $frame['@' . $name] = [$value];
        }

        return [$frame];
    }

    /**
     * @param array<mixed> $frame
     */
    public static function validateFrame(array $frame): void
    {
        if (1 !== \count($frame)) {
            throw new JsonLdException('invalid frame');
        }

        if (self::isEmptyMap($frame[0])) {
            return;
        }

        if (!\is_array($frame[0]) || (array_is_list($frame[0]) && [] !== $frame[0])) {
            throw new JsonLdException('invalid frame');
        }

        $frameObject = $frame[0];

        foreach ((array) ($frameObject[Keyword::ID->value] ?? []) as $id) {
            if (self::isEmptyMap($id)) {
                continue;
            }

            if (!\is_string($id) || !IriResolver::isAbsoluteIri($id) || str_starts_with($id, '_:')) {
                throw new JsonLdException('invalid frame');
            }
        }

        foreach ((array) ($frameObject[Keyword::TYPE->value] ?? []) as $type) {
            if (self::isEmptyMap($type) || (\is_array($type) && \array_key_exists('@default', $type))) {
                continue;
            }

            if (!\is_string($type) || !(IriResolver::isAbsoluteIri($type) || Keyword::JSON->value === $type) || str_starts_with($type, '_:')) {
                throw new JsonLdException('invalid frame');
            }
        }
    }

    public static function isSubjectReference(mixed $value): bool
    {
        return \is_array($value)
            && 1 === \count($value)
            && \array_key_exists(Keyword::ID->value, $value);
    }

    public static function isEmptyMap(mixed $value): bool
    {
        return $value instanceof \stdClass && [] === get_object_vars($value);
    }

    /**
     * @param array<string, mixed>                $pattern
     * @param array<string, mixed>                $flags
     * @param array<string, array<string, mixed>> $subjects
     */
    private static function nodeMatch(array $pattern, mixed $value, array $flags, array $subjects): bool
    {
        if (!\is_array($value) || !\array_key_exists(Keyword::ID->value, $value)) {
            return false;
        }

        $nodeObject = $subjects[$value[Keyword::ID->value]] ?? null;

        return null !== $nodeObject && self::matchesSubject($nodeObject, $pattern, $flags, $subjects);
    }

    /**
     * @param array<string, mixed> $subject
     *
     * @return array<mixed>
     */
    private static function getValues(array $subject, string $key): array
    {
        $values = $subject[$key] ?? [];

        return \is_array($values) && array_is_list($values) ? $values : [$values];
    }

    /**
     * @param array<string, mixed> $pattern
     *
     * @return array<mixed>
     */
    private static function patternValues(array $pattern, string $key): array
    {
        if (!\array_key_exists($key, $pattern)) {
            return [];
        }

        $values = $pattern[$key];

        return \is_array($values) && array_is_list($values) ? $values : [$values];
    }

    private static function isKeywordString(string $value): bool
    {
        return null !== Keyword::tryFrom($value)
            || null !== FramingKeyword::tryFrom($value)
            || '@preserve' === $value
            || '@default' === $value
            || '@null' === $value;
    }
}
