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

final class RequiredGenderModel
{
    public const DESCRIPTION = 'Audiences defined by a person\'s gender.';
    public const LABEL = 'requiredGender';
    public const NAME = 'schema:requiredGender';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PeopleAudience' => 'Jolicode\SchemaOrg\Type\PeopleAudienceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
