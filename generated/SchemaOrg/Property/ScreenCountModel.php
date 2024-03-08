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

final class ScreenCountModel
{
    public const DESCRIPTION = 'The number of screens in the movie theater.';
    public const LABEL = 'screenCount';
    public const NAME = 'schema:screenCount';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['MovieTheater' => 'SchemaOrg\\Type\\MovieTheaterModel'];
}
