<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Type;

use SchemaOrg\Property;

final class ServiceChannelModel
{
    public const DESCRIPTION = 'A means for accessing a service, e.g. a government office location, web site, or phone number.';
    public const LABEL = 'ServiceChannel';
    public const NAME = 'schema:ServiceChannel';
    public const PARENTS = ['IntangibleModel' => 'SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AvailableLanguageModel $availableLanguage = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProcessingTimeModel $processingTime = null,
        public ?Property\ProvidesServiceModel $providesService = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\ServiceLocationModel $serviceLocation = null,
        public ?Property\ServicePhoneModel $servicePhone = null,
        public ?Property\ServicePostalAddressModel $servicePostalAddress = null,
        public ?Property\ServiceSmsNumberModel $serviceSmsNumber = null,
        public ?Property\ServiceUrlModel $serviceUrl = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
