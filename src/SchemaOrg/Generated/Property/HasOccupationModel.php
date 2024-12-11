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

final class HasOccupationModel
{
    public const DESCRIPTION = 'The Person\'s occupation. For past professions, use Role for expressing dates.';
    public const LABEL = 'hasOccupation';
    public const NAME = 'schema:hasOccupation';
    public const VALUES = ['OccupationModel' => 'Jolicode\SchemaOrg\Type\OccupationModel'];
    public const TYPES = ['Person' => 'Jolicode\SchemaOrg\Type\PersonModel'];
}
