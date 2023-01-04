<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Expand;

use Jolicode\JsonLd\ContextProcessing\Context;
use Jolicode\JsonLd\JsonLd\Keyword;

class Expander
{
    public function __construct()
    {
    }

    /**
     * Takes a json_decoded JSON string as input and returns an expanded JSON string.
     *
     * This is a PHP implementation of https://www.w3.org/TR/json-ld-api/#expansion-algorithm. It is based on the 16th July 2020 recommendation.
     */
    public function expand(
        \stdClass $element,
        ?string $baseUrl = null,
        Context $activeContext = new Context(),
        string $activeProperty = '@default',
        bool $frameExpansion = false,
        bool $ordered = false,
        bool $fromMap = false,
    ): ?string {
        if (!$element) {
            return null;
        }

        if ('@default' === $activeProperty) {
            $frameExpansion = false;
        }

        if (
            property_exists($activeContext, $activeProperty) &&
            \array_key_exists(Keyword::CONTEXT->value, $activeContext[$activeProperty])
        ) {
            $propertyScopedContext = $activeContext[$activeProperty][Keyword::CONTEXT->value];
        }

        if (\is_scalar($element)) {
            if (\in_array($activeProperty, [null, Keyword::GRAPH->value], true)) {
                return null;
            }

            if (isset($propertyScopedContext)) {
                // $activeContext = context processing alorithm();
            }
        }

        return json_encode((array) $element);
    }
}
