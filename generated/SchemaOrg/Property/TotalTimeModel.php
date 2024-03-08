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

final class TotalTimeModel
{
    public const DESCRIPTION = 'The total time required to perform instructions or a direction (including time to prepare the supplies), in [ISO 8601 duration format](http://en.wikipedia.org/wiki/ISO_8601).';
    public const LABEL = 'totalTime';
    public const NAME = 'schema:totalTime';
    public const VALUES = ['DurationModel' => 'SchemaOrg\Type\DurationModel'];
    public const TYPES = ['HowToDirection' => 'SchemaOrg\Type\HowToDirectionModel', 'HowTo' => 'SchemaOrg\Type\HowToModel'];
}
