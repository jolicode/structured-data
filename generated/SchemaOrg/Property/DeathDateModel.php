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

final class DeathDateModel
{
    public const DESCRIPTION = 'Date of death.';
    public const LABEL = 'deathDate';
    public const NAME = 'schema:deathDate';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel'];
    public const TYPES = ['Person' => 'SchemaOrg\Type\PersonModel'];
}
