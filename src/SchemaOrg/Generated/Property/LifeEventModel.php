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

final class LifeEventModel
{
    public const DESCRIPTION = 'A life event like baptism, communions, Bar Mitzvahs, Aqiqah, Namakarana, Miyamairi, burial, ....';
    public const LABEL = 'lifeEvent';
    public const NAME = 'schema:lifeEvent';
    public const VALUES = ['EventModel' => 'Jolicode\SchemaOrg\Type\EventModel'];
    public const TYPES = ['Person' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
