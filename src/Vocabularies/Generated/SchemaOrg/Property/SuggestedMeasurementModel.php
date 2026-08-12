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

final class SuggestedMeasurementModel
{
    public const DESCRIPTION = 'A suggested range of body measurements for the intended audience or person, for example inseam between 32 and 34 inches or height between 170 and 190 cm. Typically found on a size chart for wearable products.';
    public const LABEL = 'suggestedMeasurement';
    public const NAME = 'schema:suggestedMeasurement';
    public const VALUES = ['QuantitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['PeopleAudience' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PeopleAudienceModel', 'SizeSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SizeSpecificationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2811'];
    public const SUPERSEDED_BY = null;
}
