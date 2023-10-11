<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator\Google;

use Jolicode\JsonLd\Generator\Google\Objects\Property;
use Jolicode\JsonLd\Generator\Google\Objects\Type;

/**
 * Sometimes the Google documentation has issues that we need to address ourselves.
 * This class is here to help setting the needed values ourselves when needed.
 */
class BrokenTypeFixer
{
    public static function fixType(Type $type): void
    {
        match ($type->name) {
            // This type HTML is broken : the table misses an opening `tr` tag, so the crawler can't find the last property.
            'Problem Walkthrough Clip' => self::fixProblemWalkthroughClip($type),
            // The last property of the beta table properties is not wrapped in a `a` tag.
            'JobPosting' => self::fixJobPosting($type),
            // The `potentialAction` value is not wrapped in a `code` tag.
            'WebSite' => self::fixWebSite($type),
            // The `rating or review` properties are not wrapped in a `code` tag.
            'SoftwareApplication' => self::fixSoftwareApplication($type),
            // At least one of the recommended properties is required, but this is hard to crawl so we add it ourselves.
            'SpecialAnnouncement' => self::fixSpecialAnnouncement($type),
            default => null,
        };
    }

    private static function fixProblemWalkthroughClip(Type $type): void
    {
        if (!$type->hasProperty('text')) {
            $type->initProperty('text', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Text');
        }
    }

    private static function fixJobPosting(Type $type): void
    {
        $type->getProperty('experienceInPlaceOfEducation')?->addValue('Boolean', true);
    }

    private static function fixWebSite(Type $type): void
    {
        $type->getProperty('potentialAction')?->addValue('SearchAction');
    }

    private static function fixSoftwareApplication(Type $type): void
    {
        if (!$type->hasProperty('atLeastOneOf_0')) {
            $properties = [
                new Property('aggregateRating', ['AggregateRating']),
                new Property('review', ['Review']),
            ];

            $type->initProperty('atLeastOneOf', Extractor::SEVERITY_REQUIRED, atLeastOneOf: $properties);
        }
    }

    private static function fixSpecialAnnouncement(Type $type): void
    {
        if (!$type->hasProperty('atLeastOneOf_0')) {
            $properties = [
                new Property('diseasePreventionInfo'),
                new Property('diseaseSpreadStatistics'),
                new Property('gettingTestedInfo'),
                new Property('governmentBenefitsInfo'),
                new Property('newsUpdatesAndGuidelines'),
                new Property('publicTransportClosuresInfo'),
                new Property('quarantineGuidelines'),
                new Property('schoolClosuresInfo'),
                new Property('travelBans'),
            ];

            $type->initProperty('atLeastOneOf', Extractor::SEVERITY_REQUIRED, atLeastOneOf: $properties);
        }
    }
}
