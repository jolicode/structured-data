<?php

namespace Jolicode\JsonLd\Expand;

use Jolicode\JsonLd\JsonLd\Keywords;
use stdClass;

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
        stdClass $element,
        string $baseUrl = '',
        array $activeContext = [],
        string $activeProperty = Keywords::DEFAULT,
        bool $frameExpansion = false,
        bool $ordered = false,
        bool $fromMap = false,
    ): ?string {
        if (!$element) {
            return null;
        }

        if (Keywords::DEFAULT === $activeProperty) {
            $frameExpansion = false;
        }

        if (
            array_key_exists($activeProperty, $activeContext) &&
            array_key_exists(Keywords::CONTEXT, $activeContext[$activeProperty])
        ) {
            $propertyScopedContext = $activeContext[$activeProperty][Keywords::CONTEXT];
        }

        if (is_scalar($element)) {
            if (in_array($activeProperty, [null, Keywords::GRAPH])) {
                return null;
            }

            if (isset($propertyScopedContext)) {
                // $activeContext = context processing alorithm();
            }
        }

        return json_encode(((array) $element));
    }
}
