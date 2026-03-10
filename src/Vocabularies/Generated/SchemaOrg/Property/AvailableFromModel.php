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

final class AvailableFromModel
{
    public const DESCRIPTION = 'When the item is available for pickup from the store, locker, etc.';
    public const LABEL = 'availableFrom';
    public const NAME = 'schema:availableFrom';
    public const VALUES = ['DateTimeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['DeliveryEvent' => 'Jolicode\Vocabularies\SchemaOrg\Type\DeliveryEventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
