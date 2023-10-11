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
            // The value cells often miss an opening `p` tag, causing the crawler to miss the values.
            // 'Movie' => self::fixMovie($type),
            // Most value cells miss an opening `p` tag, causing the crawler to miss the values.
            // 'Dataset' => self::fixDataset($type),
            // The value cell miss an opening `p` tag, causing the crawler to miss the value.
            // 'DataCatalog' => self::fixDataCatalog($type),
            // The value cell miss an opening `p` tag, causing the crawler to miss the value.
            // 'DataDownload' => self::fixDataDownload($type),
            // The value cell miss an opening `p` tag, causing the crawler to miss the value.
            // 'FAQPage' => self::fixFAQPage($type),
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

    private static function fixMovie(Type $type): void
    {
        if (!$type->hasProperty('image')) {
            $type->initProperty('image', Extractor::SEVERITY_REQUIRED);
            $type->pushProperty('URL');
            $type->pushProperty('ImageObject');
        }

        if (!$type->hasProperty('name')) {
            $type->initProperty('name', Extractor::SEVERITY_REQUIRED);
            $type->pushProperty('Text');
        }

        if (!$type->hasProperty('dateCreated')) {
            $type->initProperty('dateCreated', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Date');
            $type->pushProperty('DateTime');
        }

        if (!$type->hasProperty('director')) {
            $type->initProperty('director', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Person');
        }
    }

    private static function fixDataset(Type $type): void
    {
        if (!$type->hasProperty('description')) {
            $type->initProperty('description', Extractor::SEVERITY_REQUIRED);
            $type->pushProperty('Text');
        }

        if (!$type->hasProperty('name')) {
            $type->initProperty('name', Extractor::SEVERITY_REQUIRED);
            $type->pushProperty('Text');
        }

        if (!$type->hasProperty('alternateName')) {
            $type->initProperty('alternateName', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Text');
        }

        if (!$type->hasProperty('creator')) {
            $type->initProperty('creator', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Person');
            $type->pushProperty('Organization');
        }

        if (!$type->hasProperty('citation')) {
            $type->initProperty('citation', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Text');
            $type->pushProperty('CreativeWork');
        }

        if (!$type->hasProperty('funder')) {
            $type->initProperty('funder', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Person');
            $type->pushProperty('Organization');
        }

        if (!$type->hasProperty('identifier')) {
            $type->initProperty('identifier', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('URL');
            $type->pushProperty('Text');
            $type->pushProperty('PropertyValue');
        }

        if (!$type->hasProperty('isAccessibleForFree')) {
            $type->initProperty('isAccessibleForFree', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Boolean');
        }

        if (!$type->hasProperty('keywords')) {
            $type->initProperty('keywords', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Text');
        }

        if (!$type->hasProperty('license')) {
            $type->initProperty('license', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('URL');
            $type->pushProperty('CreativeWork');
        }

        if (!$type->hasProperty('measurementTechnique')) {
            $type->initProperty('measurementTechnique', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Text');
            $type->pushProperty('URL');
        }

        if (!$type->hasProperty('sameAs')) {
            $type->initProperty('sameAs', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('URL');
        }

        if (!$type->hasProperty('spatialCoverage')) {
            $type->initProperty('spatialCoverage', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Text');
            $type->pushProperty('Place');
        }

        if (!$type->hasProperty('temporalCoverage')) {
            $type->initProperty('temporalCoverage', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Text');
        }

        if (!$type->hasProperty('variableMeasured')) {
            $type->initProperty('variableMeasured', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Text');
            $type->pushProperty('PropertyValue');
        }

        if (!$type->hasProperty('version')) {
            $type->initProperty('version', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Text');
            $type->pushProperty('Number');
        }

        if (!$type->hasProperty('url')) {
            $type->initProperty('url', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('URL');
        }
    }

    private static function fixDataCatalog(Type $type): void
    {
        $type->getProperty('includedInDataCatalog')?->addValue('DataCatalog');
    }

    private static function fixDataDownload(Type $type): void
    {
        $type->getProperty('distribution.contentUrl')?->addValue('URL');

        $type->initProperty('distribution', Extractor::SEVERITY_RECOMMENDED);
        $type->pushProperty('Text');

        $type->initProperty('distribution.encodingFormat', Extractor::SEVERITY_RECOMMENDED);
        $type->pushProperty('Text');
        $type->pushProperty('URL');
    }

    private static function fixFAQPage(Type $type): void
    {
        $type->getProperty('mainEntity')?->addValue('Question');
    }
}
