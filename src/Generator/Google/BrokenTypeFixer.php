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
    /**
     * A method used to fix a type when it is too complicated to do it programmatically.
     * This method will receive types *before* they get cleaned up, meaning that all nested properties will
     * have the following notation : `baseType.firstProperty.secondProperty`.
     *
     * @param Type $type
     * @return void
     */
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
            // Review uses a very large list of possible values
            'Review' => self::fixReview($type),
            // AggregateRating uses the same list than Review
            'fixAggregateRating' => self::fixAggregateRating($type),
            // A value is both missing a `code` tag and a `a` tag.
            'fixBroadcastEvent' => self::fixBroadcastEvent($type),
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
                new Property('aggregateRating', [new Property('AggregateRating')]),
                new Property('review', [new Property('Review')]),
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

    private static function fixReview(Type $type): void
    {
        self::addReviewTypeValues($type);
    }

    private static function fixAggregateRating(Type $type): void
    {
        self::addReviewTypeValues($type);
    }

    private static function addReviewTypeValues(Type $type): void
    {
        $type->getProperty('itemReviewed')->addValue('Book');
        $type->getProperty('itemReviewed')->addValue('Course');
        $type->getProperty('itemReviewed')->addValue('CreativeWorkSeason');
        $type->getProperty('itemReviewed')->addValue('CreativeWorkSeries');
        $type->getProperty('itemReviewed')->addValue('Episode');
        $type->getProperty('itemReviewed')->addValue('Event');
        $type->getProperty('itemReviewed')->addValue('Game');
        $type->getProperty('itemReviewed')->addValue('HowTo');
        $type->getProperty('itemReviewed')->addValue('LocalBusiness');
        $type->getProperty('itemReviewed')->addValue('MediaObject');
        $type->getProperty('itemReviewed')->addValue('Movie');
        $type->getProperty('itemReviewed')->addValue('MusicPlaylist');
        $type->getProperty('itemReviewed')->addValue('MusicRecording');
        $type->getProperty('itemReviewed')->addValue('Organization');
        $type->getProperty('itemReviewed')->addValue('Product');
        $type->getProperty('itemReviewed')->addValue('Recipe');
        $type->getProperty('itemReviewed')->addValue('SoftwareApplication');
    }

    private static function fixBroadcastEvent(Type $type)
    {
        $type->getProperty('publication.isLiveBroadcast')->addValue('Boolean');
    }
}
