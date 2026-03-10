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

final class SuperEventModel
{
    public const DESCRIPTION = 'An event that this event is a part of. For example, a collection of individual music performances might each have a music festival as their superEvent.';
    public const LABEL = 'superEvent';
    public const NAME = 'schema:superEvent';
    public const VALUES = ['EventModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel'];
    public const TYPES = ['Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
