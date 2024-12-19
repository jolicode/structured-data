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

final class ScreenCountModel
{
    public const DESCRIPTION = 'The number of screens in the movie theater.';
    public const LABEL = 'screenCount';
    public const NAME = 'schema:screenCount';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['MovieTheater' => 'Jolicode\SchemaOrg\Type\MovieTheaterModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
