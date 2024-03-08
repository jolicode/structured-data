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

final class LegislationJurisdictionModel
{
    public const DESCRIPTION = 'The jurisdiction from which the legislation originates.';
    public const LABEL = 'legislationJurisdiction';
    public const NAME = 'schema:legislationJurisdiction';
    public const VALUES = ['AdministrativeAreaModel' => 'SchemaOrg\\Type\\AdministrativeAreaModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Legislation' => 'SchemaOrg\\Type\\LegislationModel'];
}
