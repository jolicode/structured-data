<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class AmenityFeatureModel
{
    public const DESCRIPTION = 'An amenity feature (e.g. a characteristic or service) of the Accommodation. This generic property does not make a statement about whether the feature is included in an offer for the main accommodation or available at extra costs.';
    public const LABEL = 'amenityFeature';
    public const NAME = 'schema:amenityFeature';
    public const VALUES = ['LocationFeatureSpecificationModel' => 'Jolicode\SchemaOrg\Type\LocationFeatureSpecificationModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\SchemaOrg\Type\AccommodationModel', 'FloorPlan' => 'Jolicode\SchemaOrg\Type\FloorPlanModel', 'LodgingBusiness' => 'Jolicode\SchemaOrg\Type\LodgingBusinessModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
