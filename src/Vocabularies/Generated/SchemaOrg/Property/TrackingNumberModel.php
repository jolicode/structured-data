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

final class TrackingNumberModel
{
    public const DESCRIPTION = 'Shipper tracking number.';
    public const LABEL = 'trackingNumber';
    public const NAME = 'schema:trackingNumber';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ParcelDelivery' => 'Jolicode\Vocabularies\SchemaOrg\Type\ParcelDeliveryModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
