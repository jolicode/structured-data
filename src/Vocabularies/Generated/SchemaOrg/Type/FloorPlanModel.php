<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Type;

use Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class FloorPlanModel
{
    public const DESCRIPTION = 'A FloorPlan is an explicit representation of a collection of similar accommodations, allowing the provision of common information (room counts, sizes, layout diagrams) and offers for rental or sale. In typical use, some [[ApartmentComplex]] has an [[accommodationFloorPlan]] which is a [[FloorPlan]].  A FloorPlan is always in the context of a particular place, either a larger [[ApartmentComplex]] or a single [[Apartment]]. The visual/spatial aspects of a floor plan (i.e. room layout, [see wikipedia](https://en.wikipedia.org/wiki/Floor_plan)) can be indicated using [[image]].';
    public const LABEL = 'FloorPlan';
    public const NAME = 'schema:FloorPlan';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2373'];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AmenityFeatureModel $amenityFeature = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\FloorSizeModel $floorSize = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\IsPlanForApartmentModel $isPlanForApartment = null,
        public ?Property\LayoutImageModel $layoutImage = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\NumberOfAccommodationUnitsModel $numberOfAccommodationUnits = null,
        public ?Property\NumberOfAvailableAccommodationUnitsModel $numberOfAvailableAccommodationUnits = null,
        public ?Property\NumberOfBathroomsTotalModel $numberOfBathroomsTotal = null,
        public ?Property\NumberOfBedroomsModel $numberOfBedrooms = null,
        public ?Property\NumberOfFullBathroomsModel $numberOfFullBathrooms = null,
        public ?Property\NumberOfPartialBathroomsModel $numberOfPartialBathrooms = null,
        public ?Property\NumberOfRoomsModel $numberOfRooms = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PetsAllowedModel $petsAllowed = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
