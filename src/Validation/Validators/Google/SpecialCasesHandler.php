<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Validators\Google;

use Jolicode\JsonLd\Validation\Mapper\MappedType;

class SpecialCasesHandler
{
    /**
     * Google often uses text to describe some rules, and it is not possible to crawl it. It must be implemented manually.
     * Sometimes it is done in the extractor, but some other times it is better to do it at runtime.
     */
    public static function handleSpecialRequiredProperties(MappedType $type, array &$missingRequiredProperties): void
    {
        if (\array_key_exists('atLeastOneOf', $missingRequiredProperties)) {
            // TODO: handle atLeastOneOf
            unset($missingRequiredProperties['atLeastOneOf']);
        }
    }

    /**
     * Google often uses text to describe some rules, and it is not possible to crawl it. It must be implemented manually.
     * Sometimes it is done in the extractor, but some other times it is better to do it at runtime.
     */
    public static function handleSpecialRecommendedProperties(MappedType $type, array &$missingRecommendedProperties): void
    {
        // "hasPart" is used on videos to indicate clips of the video.
        // Clips are not actually recommended for videos. However, if a clip is included, some of its properties are recommended.
        // Even if clips are not recommended, they are present in the recommended table of the documentation.
        if (\array_key_exists('hasPart', $missingRecommendedProperties)) {
            unset($missingRecommendedProperties['hasPart']);
        }

        if (\array_key_exists('atLeastOneOf', $missingRecommendedProperties)) {
            // TODO: handle atLeastOneOf
            unset($missingRecommendedProperties['atLeastOneOf']);
        }
    }
}
