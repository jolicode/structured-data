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

final class RepeatCountModel
{
    public const DESCRIPTION = 'Defines the number of times a recurring [[Event]] will take place.';
    public const LABEL = 'repeatCount';
    public const NAME = 'schema:repeatCount';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\\Type\\IntegerModel'];
    public const TYPES = ['Schedule' => 'SchemaOrg\\Type\\ScheduleModel'];
}
