<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class AvailableFromModel
{
    public const DESCRIPTION = 'When the item is available for pickup from the store, locker, etc.';
    public const LABEL = 'availableFrom';
    public const NAME = 'schema:availableFrom';
    public const VALUES = ['DateTimeModel' => 'SchemaOrg\\Type\\DateTimeModel'];
    public const TYPES = ['DeliveryEvent' => 'SchemaOrg\\Type\\DeliveryEventModel'];
}
