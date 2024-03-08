<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class PotentialActionModel
{
    public const DESCRIPTION = 'Indicates a potential Action, which describes an idealized action in which this thing would play an \'object\' role.';
    public const LABEL = 'potentialAction';
    public const NAME = 'schema:potentialAction';
    public const VALUES = ['ActionModel' => 'SchemaOrg\\Type\\ActionModel'];
    public const TYPES = ['Thing' => 'SchemaOrg\\Type\\ThingModel'];
}
