<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class PetsAllowedModel
{
    public const DESCRIPTION = 'Indicates whether pets are allowed to enter the accommodation or lodging business. More detailed information can be put in a text value.';
    public const LABEL = 'petsAllowed';
    public const NAME = 'schema:petsAllowed';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\Type\BooleanModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Accommodation' => 'SchemaOrg\Type\AccommodationModel', 'ApartmentComplex' => 'SchemaOrg\Type\ApartmentComplexModel', 'FloorPlan' => 'SchemaOrg\Type\FloorPlanModel', 'LodgingBusiness' => 'SchemaOrg\Type\LodgingBusinessModel'];
}
