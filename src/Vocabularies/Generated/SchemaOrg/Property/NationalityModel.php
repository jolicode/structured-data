<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class NationalityModel
{
    public const DESCRIPTION = 'Nationality of the person.';
    public const LABEL = 'nationality';
    public const NAME = 'schema:nationality';
    public const VALUES = ['CountryModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CountryModel'];
    public const TYPES = ['Person' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
