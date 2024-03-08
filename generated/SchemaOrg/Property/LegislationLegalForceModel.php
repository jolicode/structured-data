<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class LegislationLegalForceModel
{
    public const DESCRIPTION = 'Whether the legislation is currently in force, not in force, or partially in force.';
    public const LABEL = 'legislationLegalForce';
    public const NAME = 'schema:legislationLegalForce';
    public const VALUES = ['LegalForceStatusModel' => 'SchemaOrg\Type\LegalForceStatusModel'];
    public const TYPES = ['Legislation' => 'SchemaOrg\Type\LegislationModel'];
}
