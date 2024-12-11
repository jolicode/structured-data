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

final class OpensModel
{
    public const DESCRIPTION = 'The opening hour of the place or service on the given day(s) of the week.';
    public const LABEL = 'opens';
    public const NAME = 'schema:opens';
    public const VALUES = ['TimeModel' => 'Jolicode\SchemaOrg\Type\TimeModel'];
    public const TYPES = ['OpeningHoursSpecification' => 'Jolicode\SchemaOrg\Type\OpeningHoursSpecificationModel'];
}
