<?php

declare(strict_types=1);

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

final class ReturnLabelSourceEnumerationModel
{
    public const DESCRIPTION = 'Enumerates several types of return labels for product returns.';
    public const LABEL = 'ReturnLabelSourceEnumeration';
    public const NAME = 'schema:ReturnLabelSourceEnumeration';
    public const PARENTS = ['EnumerationModel' => 'SchemaOrg\\Type\\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['ReturnLabelCustomerResponsibilityModel' => 'EnumerationMember\\ReturnLabelCustomerResponsibilityModel', 'ReturnLabelDownloadAndPrintModel' => 'EnumerationMember\\ReturnLabelDownloadAndPrintModel', 'ReturnLabelInBoxModel' => 'EnumerationMember\\ReturnLabelInBoxModel'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
