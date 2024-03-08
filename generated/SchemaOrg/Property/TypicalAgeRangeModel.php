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

final class TypicalAgeRangeModel
{
    public const DESCRIPTION = 'The typical expected age range, e.g. \'7-9\', \'11-\'.';
    public const LABEL = 'typicalAgeRange';
    public const NAME = 'schema:typicalAgeRange';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'Event' => 'SchemaOrg\Type\EventModel'];
}
