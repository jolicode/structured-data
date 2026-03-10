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

final class NaicsModel
{
    public const DESCRIPTION = 'The North American Industry Classification System (NAICS) code for a particular organization or business person.';
    public const LABEL = 'naics';
    public const NAME = 'schema:naics';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
