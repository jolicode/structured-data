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

final class BirthDateModel
{
    public const DESCRIPTION = 'Date of birth.';
    public const LABEL = 'birthDate';
    public const NAME = 'schema:birthDate';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel'];
    public const TYPES = ['Person' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
