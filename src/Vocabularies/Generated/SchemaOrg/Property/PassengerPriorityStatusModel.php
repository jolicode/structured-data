<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class PassengerPriorityStatusModel
{
    public const DESCRIPTION = 'The priority status assigned to a passenger for security or boarding (e.g. FastTrack or Priority).';
    public const LABEL = 'passengerPriorityStatus';
    public const NAME = 'schema:passengerPriorityStatus';
    public const VALUES = ['QualitativeValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['FlightReservation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\FlightReservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
