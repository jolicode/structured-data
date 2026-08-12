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

final class SeasonalOverrideModel
{
    public const DESCRIPTION = 'Limited period during which these shipping conditions apply.';
    public const LABEL = 'seasonalOverride';
    public const NAME = 'schema:seasonalOverride';
    public const VALUES = ['OpeningHoursSpecificationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OpeningHoursSpecificationModel'];
    public const TYPES = ['ShippingConditions' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ShippingConditionsModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3617'];
    public const SUPERSEDED_BY = null;
}
