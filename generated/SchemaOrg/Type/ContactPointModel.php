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

final class ContactPointModel
{
    public const DESCRIPTION = 'A contact point&#x2014;for example, a Customer Complaints department.';
    public const LABEL = 'ContactPoint';
    public const NAME = 'schema:ContactPoint';
    public const PARENTS = ['StructuredValueModel' => 'SchemaOrg\Type\StructuredValueModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
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
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProductSupportedModel $productSupported = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\ServiceAreaModel $serviceArea = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TelephoneModel $telephone = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
