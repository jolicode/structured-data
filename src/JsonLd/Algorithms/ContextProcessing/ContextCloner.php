<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Algorithms\ContextProcessing;

final class ContextCloner
{
    public static function duplicate(Context $context): Context
    {
        $copies = [];

        return self::duplicateContext($context, $copies);
    }

    /**
     * @param array<int, Context> $copies
     */
    private static function duplicateContext(Context $context, array &$copies): Context
    {
        $objectId = spl_object_id($context);

        if (isset($copies[$objectId])) {
            return $copies[$objectId];
        }

        $copy = new Context(
            baseIri: $context->baseIri,
            baseUrl: $context->baseUrl,
            vocabularyMapping: $context->vocabularyMapping,
            defaultLangage: $context->defaultLangage,
            defaultBaseDirection: $context->defaultBaseDirection,
            processingMode: $context->processingMode,
        );

        $copies[$objectId] = $copy;

        $copy->termDefinitions = $context->termDefinitions;

        $copy->inverseContext = $context->inverseContext ? self::duplicateContext($context->inverseContext, $copies) : null;
        $copy->previousContext = $context->previousContext ? self::duplicateContext($context->previousContext, $copies) : null;

        return $copy;
    }
}
