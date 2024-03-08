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

final class JurisdictionModel
{
    public const DESCRIPTION = 'Indicates a legal jurisdiction, e.g. of some legislation, or where some government service is based.';
    public const LABEL = 'jurisdiction';
    public const NAME = 'schema:jurisdiction';
    public const VALUES = ['AdministrativeAreaModel' => 'SchemaOrg\\Type\\AdministrativeAreaModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['GovernmentService' => 'SchemaOrg\\Type\\GovernmentServiceModel', 'Legislation' => 'SchemaOrg\\Type\\LegislationModel'];
}
