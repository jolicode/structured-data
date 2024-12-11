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

final class SecurityScreeningModel
{
    public const DESCRIPTION = 'The type of security screening the passenger is subject to.';
    public const LABEL = 'securityScreening';
    public const NAME = 'schema:securityScreening';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['FlightReservation' => 'Jolicode\SchemaOrg\Type\FlightReservationModel'];
}
