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

final class DeliveryMethodModel
{
    public const DESCRIPTION = 'A sub property of instrument. The method of delivery.';
    public const LABEL = 'deliveryMethod';
    public const NAME = 'schema:deliveryMethod';
    public const VALUES = ['DeliveryMethodModel' => 'Jolicode\SchemaOrg\Type\DeliveryMethodModel'];
    public const TYPES = ['OrderAction' => 'Jolicode\SchemaOrg\Type\OrderActionModel', 'ReceiveAction' => 'Jolicode\SchemaOrg\Type\ReceiveActionModel', 'SendAction' => 'Jolicode\SchemaOrg\Type\SendActionModel', 'TrackAction' => 'Jolicode\SchemaOrg\Type\TrackActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
