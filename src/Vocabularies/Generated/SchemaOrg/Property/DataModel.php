<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class DataModel
{
    public const DESCRIPTION = 'Data associated with the event, like for instance a log message.';
    public const LABEL = 'data';
    public const NAME = 'schema:data';
    public const VALUES = ['ThingModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['InstantaneousEvent' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\InstantaneousEventModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/4527'];
    public const SUPERSEDED_BY = null;
}
