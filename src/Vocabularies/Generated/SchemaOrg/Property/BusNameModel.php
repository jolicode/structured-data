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

final class BusNameModel
{
    public const DESCRIPTION = 'The name of the bus (e.g. Bolt Express).';
    public const LABEL = 'busName';
    public const NAME = 'schema:busName';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BusTrip' => 'Jolicode\Vocabularies\SchemaOrg\Type\BusTripModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
