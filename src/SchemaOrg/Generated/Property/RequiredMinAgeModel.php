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

final class RequiredMinAgeModel
{
    public const DESCRIPTION = 'Audiences defined by a person\'s minimum age.';
    public const LABEL = 'requiredMinAge';
    public const NAME = 'schema:requiredMinAge';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['PeopleAudience' => 'Jolicode\SchemaOrg\Type\PeopleAudienceModel'];
}
