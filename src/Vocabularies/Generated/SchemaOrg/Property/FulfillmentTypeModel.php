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

final class FulfillmentTypeModel
{
    public const DESCRIPTION = 'Type of fulfillment applicable to the [[ShippingService]].';
    public const LABEL = 'fulfillmentType';
    public const NAME = 'schema:fulfillmentType';
    public const VALUES = ['FulfillmentTypeEnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\FulfillmentTypeEnumerationModel'];
    public const TYPES = ['ShippingService' => 'Jolicode\Vocabularies\SchemaOrg\Type\ShippingServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
