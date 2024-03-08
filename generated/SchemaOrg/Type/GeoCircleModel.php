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

final class GeoCircleModel
{
    public const DESCRIPTION = 'A GeoCircle is a GeoShape representing a circular geographic area. As it is a GeoShape
          it provides the simple textual property \'circle\', but also allows the combination of postalCode alongside geoRadius.
          The center of the circle can be indicated via the \'geoMidpoint\' property, or more approximately using \'address\', \'postalCode\'.
       ';
    public const LABEL = 'GeoCircle';
    public const NAME = 'schema:GeoCircle';
    public const PARENTS = ['GeoShapeModel' => 'SchemaOrg\\Type\\GeoShapeModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AddressModel $address = null,
        public ?Property\AddressCountryModel $addressCountry = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\BoxModel $box = null,
        public ?Property\CircleModel $circle = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\ElevationModel $elevation = null,
        public ?Property\GeoMidpointModel $geoMidpoint = null,
        public ?Property\GeoRadiusModel $geoRadius = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\LineModel $line = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PolygonModel $polygon = null,
        public ?Property\PostalCodeModel $postalCode = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
