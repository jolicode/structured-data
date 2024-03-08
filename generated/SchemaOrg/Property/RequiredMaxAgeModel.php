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

final class RequiredMaxAgeModel
{
    public const DESCRIPTION = 'Audiences defined by a person\'s maximum age.';
    public const LABEL = 'requiredMaxAge';
    public const NAME = 'schema:requiredMaxAge';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['PeopleAudience' => 'SchemaOrg\Type\PeopleAudienceModel'];
}
