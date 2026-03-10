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

final class SourceModel
{
    public const DESCRIPTION = 'The source or cause of the event.';
    public const LABEL = 'source';
    public const NAME = 'schema:source';
    public const VALUES = ['ThingModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['InstantaneousEvent' => 'Jolicode\Vocabularies\SchemaOrg\Type\InstantaneousEventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
