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

final class SuggestedMinAgeModel
{
    public const DESCRIPTION = 'Minimum recommended age in years for the audience or user.';
    public const LABEL = 'suggestedMinAge';
    public const NAME = 'schema:suggestedMinAge';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['PeopleAudience' => 'Jolicode\SchemaOrg\Type\PeopleAudienceModel'];
}
