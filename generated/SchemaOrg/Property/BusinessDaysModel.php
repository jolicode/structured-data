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

final class BusinessDaysModel
{
    public const DESCRIPTION = 'Days of the week when the merchant typically operates, indicated via opening hours markup.';
    public const LABEL = 'businessDays';
    public const NAME = 'schema:businessDays';
    public const VALUES = ['OpeningHoursSpecificationModel' => 'SchemaOrg\Type\OpeningHoursSpecificationModel'];
    public const TYPES = ['ShippingDeliveryTime' => 'SchemaOrg\Type\ShippingDeliveryTimeModel'];
}
