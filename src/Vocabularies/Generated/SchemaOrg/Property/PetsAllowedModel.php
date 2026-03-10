<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class PetsAllowedModel
{
    public const DESCRIPTION = 'Indicates whether pets are allowed to enter the accommodation or lodging business. More detailed information can be put in a text value.';
    public const LABEL = 'petsAllowed';
    public const NAME = 'schema:petsAllowed';
    public const VALUES = ['BooleanModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BooleanModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\Vocabularies\SchemaOrg\Type\AccommodationModel', 'ApartmentComplex' => 'Jolicode\Vocabularies\SchemaOrg\Type\ApartmentComplexModel', 'FloorPlan' => 'Jolicode\Vocabularies\SchemaOrg\Type\FloorPlanModel', 'LodgingBusiness' => 'Jolicode\Vocabularies\SchemaOrg\Type\LodgingBusinessModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
