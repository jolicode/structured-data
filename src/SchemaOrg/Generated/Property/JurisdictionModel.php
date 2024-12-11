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

final class JurisdictionModel
{
    public const DESCRIPTION = 'Indicates a legal jurisdiction, e.g. of some legislation, or where some government service is based.';
    public const LABEL = 'jurisdiction';
    public const NAME = 'schema:jurisdiction';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\SchemaOrg\Type\AdministrativeAreaModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['GovernmentService' => 'Jolicode\SchemaOrg\Type\GovernmentServiceModel', 'Legislation' => 'Jolicode\SchemaOrg\Type\LegislationModel'];
}
