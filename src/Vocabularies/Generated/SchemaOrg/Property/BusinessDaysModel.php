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

final class BusinessDaysModel
{
    public const DESCRIPTION = 'Days of the week when the merchant typically operates, indicated via opening hours markup.';
    public const LABEL = 'businessDays';
    public const NAME = 'schema:businessDays';
    public const VALUES = ['DayOfWeekModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DayOfWeekModel', 'OpeningHoursSpecificationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OpeningHoursSpecificationModel'];
    public const TYPES = ['ServicePeriod' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ServicePeriodModel', 'ShippingDeliveryTime' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ShippingDeliveryTimeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2506', 'https://github.com/schemaorg/schemaorg/issues/3617'];
    public const SUPERSEDED_BY = null;
}
