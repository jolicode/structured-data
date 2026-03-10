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

final class DeliveryMethodModel
{
    public const DESCRIPTION = 'A sub property of instrument. The method of delivery.';
    public const LABEL = 'deliveryMethod';
    public const NAME = 'schema:deliveryMethod';
    public const VALUES = ['DeliveryMethodModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DeliveryMethodModel'];
    public const TYPES = ['OrderAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrderActionModel', 'ReceiveAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\ReceiveActionModel', 'SendAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\SendActionModel', 'TrackAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\TrackActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
