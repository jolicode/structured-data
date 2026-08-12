<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class PetsAllowedModel
{
    public const DESCRIPTION = 'Indicates whether pets are allowed to enter the accommodation or lodging business. More detailed information can be put in a text value.';
    public const LABEL = 'petsAllowed';
    public const NAME = 'schema:petsAllowed';
    public const VALUES = ['BooleanModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BooleanModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Accommodation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AccommodationModel', 'ApartmentComplex' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ApartmentComplexModel', 'FloorPlan' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\FloorPlanModel', 'LodgingBusiness' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LodgingBusinessModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
