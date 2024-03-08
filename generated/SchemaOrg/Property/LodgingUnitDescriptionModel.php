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

final class LodgingUnitDescriptionModel
{
    public const DESCRIPTION = 'A full description of the lodging unit.';
    public const LABEL = 'lodgingUnitDescription';
    public const NAME = 'schema:lodgingUnitDescription';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['LodgingReservation' => 'SchemaOrg\\Type\\LodgingReservationModel'];
}
