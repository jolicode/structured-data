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

final class CheckoutTimeModel
{
    public const DESCRIPTION = 'The latest someone may check out of a lodging establishment.';
    public const LABEL = 'checkoutTime';
    public const NAME = 'schema:checkoutTime';
    public const VALUES = ['DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel', 'TimeModel' => 'Jolicode\SchemaOrg\Type\TimeModel'];
    public const TYPES = ['LodgingBusiness' => 'Jolicode\SchemaOrg\Type\LodgingBusinessModel', 'LodgingReservation' => 'Jolicode\SchemaOrg\Type\LodgingReservationModel'];
}
