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

final class BusinessDaysModel
{
    public const DESCRIPTION = 'Days of the week when the merchant typically operates, indicated via opening hours markup.';
    public const LABEL = 'businessDays';
    public const NAME = 'schema:businessDays';
    public const VALUES = ['DayOfWeekModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DayOfWeekModel', 'OpeningHoursSpecificationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OpeningHoursSpecificationModel'];
    public const TYPES = ['ServicePeriod' => 'Jolicode\Vocabularies\SchemaOrg\Type\ServicePeriodModel', 'ShippingDeliveryTime' => 'Jolicode\Vocabularies\SchemaOrg\Type\ShippingDeliveryTimeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
