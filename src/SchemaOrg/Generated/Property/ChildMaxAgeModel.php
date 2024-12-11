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

final class ChildMaxAgeModel
{
    public const DESCRIPTION = 'Maximal age of the child.';
    public const LABEL = 'childMaxAge';
    public const NAME = 'schema:childMaxAge';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['ParentAudience' => 'Jolicode\SchemaOrg\Type\ParentAudienceModel'];
}
