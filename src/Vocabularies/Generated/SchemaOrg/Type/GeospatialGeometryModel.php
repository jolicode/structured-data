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

final class GeospatialGeometryModel
{
    public const DESCRIPTION = '(Eventually to be defined as) a supertype of GeoShape designed to accommodate definitions from Geo-Spatial best practices.';
    public const LABEL = 'GeospatialGeometry';
    public const NAME = 'schema:GeospatialGeometry';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1375'];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\GeoContainsModel $geoContains = null,
        public ?Property\GeoCoveredByModel $geoCoveredBy = null,
        public ?Property\GeoCoversModel $geoCovers = null,
        public ?Property\GeoCrossesModel $geoCrosses = null,
        public ?Property\GeoDisjointModel $geoDisjoint = null,
        public ?Property\GeoEqualsModel $geoEquals = null,
        public ?Property\GeoIntersectsModel $geoIntersects = null,
        public ?Property\GeoOverlapsModel $geoOverlaps = null,
        public ?Property\GeoTouchesModel $geoTouches = null,
        public ?Property\GeoWithinModel $geoWithin = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
