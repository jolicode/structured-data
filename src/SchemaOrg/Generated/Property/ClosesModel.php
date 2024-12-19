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

final class ClosesModel
{
    public const DESCRIPTION = 'The closing hour of the place or service on the given day(s) of the week.';
    public const LABEL = 'closes';
    public const NAME = 'schema:closes';
    public const VALUES = ['TimeModel' => 'Jolicode\SchemaOrg\Type\TimeModel'];
    public const TYPES = ['OpeningHoursSpecification' => 'Jolicode\SchemaOrg\Type\OpeningHoursSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
