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

final class HasDeliveryMethodModel
{
    public const DESCRIPTION = 'Method used for delivery or shipping.';
    public const LABEL = 'hasDeliveryMethod';
    public const NAME = 'schema:hasDeliveryMethod';
    public const VALUES = ['DeliveryMethodModel' => 'Jolicode\SchemaOrg\Type\DeliveryMethodModel'];
    public const TYPES = ['DeliveryEvent' => 'Jolicode\SchemaOrg\Type\DeliveryEventModel', 'ParcelDelivery' => 'Jolicode\SchemaOrg\Type\ParcelDeliveryModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
