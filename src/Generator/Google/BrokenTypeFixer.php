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

use Jolicode\JsonLd\Generator\Google\Objects\MainType;
use Jolicode\JsonLd\Generator\Google\Objects\Property;
use Jolicode\JsonLd\Generator\Google\Objects\PropertyType;

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
     */
    public static function fixType(MainType $type): void
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
            'AggregateRating' => self::fixAggregateRating($type),
            // Some values are a bit hard to crawl, it is easier to handle them this way.
            'VideoObject' => self::fixVideoObject($type),
            // A value is missing both a `code` tag and a `a` tag.
            'BroadcastEvent' => self::fixBroadcastEvent($type),
            default => null,
        };
    }

    private static function fixProblemWalkthroughClip(MainType $type): void
    {
        if (!$type->hasProperty('text')) {
            $type->initProperty('text', Extractor::SEVERITY_RECOMMENDED);
            $type->pushProperty('Text');
        }
    }

    private static function fixJobPosting(MainType $type): void
    {
        $type->getProperty('experienceInPlaceOfEducation')->addType('Boolean');
    }

    private static function fixWebSite(MainType $type): void
    {
        $type->getProperty('potentialAction')?->addType('SearchAction');
    }

    private static function fixSoftwareApplication(MainType $type): void
    {
        if (!$type->hasProperty('atLeastOneOf_0')) {
            $properties = [
                new PropertyType('aggregateRating', ['AggregateRating' => new Property('AggregateRating')]),
                new PropertyType('review', ['Review' => new Property('Review')]),
            ];

            $type->initProperty('atLeastOneOf', Extractor::SEVERITY_REQUIRED, atLeastOneOf: $properties);
        }

        $type->getProperty('applicationCategory')->addType('GameApplication');
        $type->getProperty('applicationCategory')->addType('SocialNetworkingApplication');
        $type->getProperty('applicationCategory')->addType('TravelApplication');
        $type->getProperty('applicationCategory')->addType('ShoppingApplication');
        $type->getProperty('applicationCategory')->addType('SportsApplication');
        $type->getProperty('applicationCategory')->addType('LifestyleApplication');
        $type->getProperty('applicationCategory')->addType('BusinessApplication');
        $type->getProperty('applicationCategory')->addType('DesignApplication');
        $type->getProperty('applicationCategory')->addType('DeveloperApplication');
        $type->getProperty('applicationCategory')->addType('DriverApplication');
        $type->getProperty('applicationCategory')->addType('EducationalApplication');
        $type->getProperty('applicationCategory')->addType('HealthApplication');
        $type->getProperty('applicationCategory')->addType('FinanceApplication');
        $type->getProperty('applicationCategory')->addType('SecurityApplication');
        $type->getProperty('applicationCategory')->addType('BrowserApplication');
        $type->getProperty('applicationCategory')->addType('CommunicationApplication');
        $type->getProperty('applicationCategory')->addType('DesktopEnhancementApplication');
        $type->getProperty('applicationCategory')->addType('EntertainmentApplication');
        $type->getProperty('applicationCategory')->addType('MultiMediaApplication');
        $type->getProperty('applicationCategory')->addType('HomeApplication');
        $type->getProperty('applicationCategory')->addType('UtilitiesApplication');
        $type->getProperty('applicationCategory')->addType('ReferenceApplication');
        $type->getProperty('applicationCategory')->removeType('Text');
    }

    private static function fixSpecialAnnouncement(MainType $type): void
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

    private static function fixReview(MainType $type): void
    {
        self::addReviewTypeValues($type);
    }

    private static function fixAggregateRating(MainType $type): void
    {
        self::addReviewTypeValues($type);
    }

    private static function addReviewTypeValues(MainType $type): void
    {
        $type->getProperty('itemReviewed')->addType('Book');
        $type->getProperty('itemReviewed')->addType('Course');
        $type->getProperty('itemReviewed')->addType('CreativeWorkSeason');
        $type->getProperty('itemReviewed')->addType('CreativeWorkSeries');
        $type->getProperty('itemReviewed')->addType('Episode');
        $type->getProperty('itemReviewed')->addType('Event');
        $type->getProperty('itemReviewed')->addType('Game');
        $type->getProperty('itemReviewed')->addType('HowTo');
        $type->getProperty('itemReviewed')->addType('LocalBusiness');
        $type->getProperty('itemReviewed')->addType('MediaObject');
        $type->getProperty('itemReviewed')->addType('Movie');
        $type->getProperty('itemReviewed')->addType('MusicPlaylist');
        $type->getProperty('itemReviewed')->addType('MusicRecording');
        $type->getProperty('itemReviewed')->addType('Organization');
        $type->getProperty('itemReviewed')->addType('Product');
        $type->getProperty('itemReviewed')->addType('Recipe');
        $type->getProperty('itemReviewed')->addType('SoftwareApplication');
    }

    private static function fixBroadcastEvent(MainType $type)
    {
        $type->getProperty('publication.isLiveBroadcast')->addType('Boolean');
    }

    private static function fixVideoObject(MainType $type)
    {
        $type->getProperty('hasPart')->addType('Clip');
        $type->getProperty('publication')->addType('BroadcastEvent');
    }
}
