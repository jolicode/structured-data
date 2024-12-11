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

final class PetsAllowedModel
{
    public const DESCRIPTION = 'Indicates whether pets are allowed to enter the accommodation or lodging business. More detailed information can be put in a text value.';
    public const LABEL = 'petsAllowed';
    public const NAME = 'schema:petsAllowed';
    public const VALUES = ['BooleanModel' => 'Jolicode\SchemaOrg\Type\BooleanModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\SchemaOrg\Type\AccommodationModel', 'ApartmentComplex' => 'Jolicode\SchemaOrg\Type\ApartmentComplexModel', 'FloorPlan' => 'Jolicode\SchemaOrg\Type\FloorPlanModel', 'LodgingBusiness' => 'Jolicode\SchemaOrg\Type\LodgingBusinessModel'];
}
