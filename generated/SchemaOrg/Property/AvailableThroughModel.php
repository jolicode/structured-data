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

final class AvailableThroughModel
{
    public const DESCRIPTION = 'After this date, the item will no longer be available for pickup.';
    public const LABEL = 'availableThrough';
    public const NAME = 'schema:availableThrough';
    public const VALUES = ['DateTimeModel' => 'SchemaOrg\\Type\\DateTimeModel'];
    public const TYPES = ['DeliveryEvent' => 'SchemaOrg\\Type\\DeliveryEventModel'];
}
