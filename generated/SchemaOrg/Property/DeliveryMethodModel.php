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

final class DeliveryMethodModel
{
    public const DESCRIPTION = 'A sub property of instrument. The method of delivery.';
    public const LABEL = 'deliveryMethod';
    public const NAME = 'schema:deliveryMethod';
    public const VALUES = ['DeliveryMethodModel' => 'SchemaOrg\Type\DeliveryMethodModel'];
    public const TYPES = ['OrderAction' => 'SchemaOrg\Type\OrderActionModel', 'ReceiveAction' => 'SchemaOrg\Type\ReceiveActionModel', 'SendAction' => 'SchemaOrg\Type\SendActionModel', 'TrackAction' => 'SchemaOrg\Type\TrackActionModel'];
}
