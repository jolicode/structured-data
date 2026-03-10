<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class TimestampModel
{
    public const DESCRIPTION = 'The instant the event occured.';
    public const LABEL = 'timestamp';
    public const NAME = 'schema:timestamp';
    public const VALUES = ['DateTimeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['InstantaneousEvent' => 'Jolicode\Vocabularies\SchemaOrg\Type\InstantaneousEventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
