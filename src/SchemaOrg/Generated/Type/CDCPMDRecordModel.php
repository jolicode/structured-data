<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Type;

use Jolicode\SchemaOrg\Property;

final class CDCPMDRecordModel
{
    public const DESCRIPTION = 'A CDCPMDRecord is a data structure representing a record in a CDC tabular data format
      used for hospital data reporting. See [documentation](/docs/cdc-covid.html) for details, and the linked CDC materials for authoritative
      definitions used as the source here.';
    public const LABEL = 'CDCPMDRecord';
    public const NAME = 'schema:CDCPMDRecord';
    public const PARENTS = ['StructuredValueModel' => 'Jolicode\SchemaOrg\Type\StructuredValueModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2521'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\CvdCollectionDateModel $cvdCollectionDate = null,
        public ?Property\CvdFacilityCountyModel $cvdFacilityCounty = null,
        public ?Property\CvdFacilityIdModel $cvdFacilityId = null,
        public ?Property\CvdNumBedsModel $cvdNumBeds = null,
        public ?Property\CvdNumBedsOccModel $cvdNumBedsOcc = null,
        public ?Property\CvdNumC19DiedModel $cvdNumC19Died = null,
        public ?Property\CvdNumC19HOPatsModel $cvdNumC19HOPats = null,
        public ?Property\CvdNumC19HospPatsModel $cvdNumC19HospPats = null,
        public ?Property\CvdNumC19MechVentPatsModel $cvdNumC19MechVentPats = null,
        public ?Property\CvdNumC19OFMechVentPatsModel $cvdNumC19OFMechVentPats = null,
        public ?Property\CvdNumC19OverflowPatsModel $cvdNumC19OverflowPats = null,
        public ?Property\CvdNumICUBedsModel $cvdNumICUBeds = null,
        public ?Property\CvdNumICUBedsOccModel $cvdNumICUBedsOcc = null,
        public ?Property\CvdNumTotBedsModel $cvdNumTotBeds = null,
        public ?Property\CvdNumVentModel $cvdNumVent = null,
        public ?Property\CvdNumVentUseModel $cvdNumVentUse = null,
        public ?Property\DatePostedModel $datePosted = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
