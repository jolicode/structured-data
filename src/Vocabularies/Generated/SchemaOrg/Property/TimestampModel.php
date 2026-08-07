<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class TimestampModel
{
    public const DESCRIPTION = 'The instant the event occured.';
    public const LABEL = 'timestamp';
    public const NAME = 'schema:timestamp';
    public const VALUES = ['DateTimeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['InstantaneousEvent' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\InstantaneousEventModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/4527'];
    public const SUPERSEDED_BY = null;
}
