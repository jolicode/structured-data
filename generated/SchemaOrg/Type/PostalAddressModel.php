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

final class PostalAddressModel
{
    public const DESCRIPTION = 'The mailing address.';
    public const LABEL = 'PostalAddress';
    public const NAME = 'schema:PostalAddress';
    public const PARENTS = ['ContactPointModel' => 'SchemaOrg\Type\ContactPointModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AddressCountryModel $addressCountry = null,
        public ?Property\AddressLocalityModel $addressLocality = null,
        public ?Property\AddressRegionModel $addressRegion = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AreaServedModel $areaServed = null,
        public ?Property\AvailableLanguageModel $availableLanguage = null,
        public ?Property\ContactOptionModel $contactOption = null,
        public ?Property\ContactTypeModel $contactType = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EmailModel $email = null,
        public ?Property\FaxNumberModel $faxNumber = null,
        public ?Property\HoursAvailableModel $hoursAvailable = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PostOfficeBoxNumberModel $postOfficeBoxNumber = null,
        public ?Property\PostalCodeModel $postalCode = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProductSupportedModel $productSupported = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\ServiceAreaModel $serviceArea = null,
        public ?Property\StreetAddressModel $streetAddress = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TelephoneModel $telephone = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
