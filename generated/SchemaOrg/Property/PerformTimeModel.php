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

final class PerformTimeModel
{
    public const DESCRIPTION = 'The length of time it takes to perform instructions or a direction (not including time to prepare the supplies), in [ISO 8601 duration format](http://en.wikipedia.org/wiki/ISO_8601).';
    public const LABEL = 'performTime';
    public const NAME = 'schema:performTime';
    public const VALUES = ['DurationModel' => 'SchemaOrg\\Type\\DurationModel'];
    public const TYPES = ['HowToDirection' => 'SchemaOrg\\Type\\HowToDirectionModel', 'HowTo' => 'SchemaOrg\\Type\\HowToModel'];
}
