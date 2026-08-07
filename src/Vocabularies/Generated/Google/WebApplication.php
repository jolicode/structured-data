<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\Google;

final class WebApplication
{
    public const SUPPORTED_TYPES = ['WebApplication'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/software-app';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'name' => [
            'name' => 'name',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'offers' => [
            'name' => 'offers',
            'severity' => 'required',
            'supportedTypes' => [
                'Offer',
            ],
            'properties' => [
                'price' => [
                    'name' => 'price',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Number',
                    ],
                ],
                'priceCurrency' => [
                    'name' => 'priceCurrency',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
            ],
        ],
        'atLeastOneOf' => [
            'name' => 'atLeastOneOf',
            'severity' => 'required',
            'value' => [
                'aggregateRating' => true,
                'review' => true,
            ],
            'supportedTypes' => [
            ],
        ],
        'applicationCategory' => [
            'name' => 'applicationCategory',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
            'value' => [
                'GameApplication',
                'SocialNetworkingApplication',
                'TravelApplication',
                'ShoppingApplication',
                'SportsApplication',
                'LifestyleApplication',
                'BusinessApplication',
                'DesignApplication',
                'DeveloperApplication',
                'DriverApplication',
                'EducationalApplication',
                'HealthApplication',
                'FinanceApplication',
                'SecurityApplication',
                'BrowserApplication',
                'CommunicationApplication',
                'DesktopEnhancementApplication',
                'EntertainmentApplication',
                'MultimediaApplication',
                'HomeApplication',
                'UtilitiesApplication',
                'ReferenceApplication',
            ],
        ],
        'operatingSystem' => [
            'name' => 'operatingSystem',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
    ];
}
