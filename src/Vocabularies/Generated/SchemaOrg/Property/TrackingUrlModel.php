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

final class TrackingUrlModel
{
    public const DESCRIPTION = 'Tracking url for the parcel delivery.';
    public const LABEL = 'trackingUrl';
    public const NAME = 'schema:trackingUrl';
    public const VALUES = ['URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['ParcelDelivery' => 'Jolicode\Vocabularies\SchemaOrg\Type\ParcelDeliveryModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
