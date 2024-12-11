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

final class EndorseeModel
{
    public const DESCRIPTION = 'A sub property of participant. The person/organization being supported.';
    public const LABEL = 'endorsee';
    public const NAME = 'schema:endorsee';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['EndorseAction' => 'Jolicode\SchemaOrg\Type\EndorseActionModel'];
}
