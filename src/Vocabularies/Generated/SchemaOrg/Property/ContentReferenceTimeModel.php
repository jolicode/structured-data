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

final class ContentReferenceTimeModel
{
    public const DESCRIPTION = 'The specific time described by a creative work, for works (e.g. articles, video objects etc.) that emphasise a particular moment within an Event.';
    public const LABEL = 'contentReferenceTime';
    public const NAME = 'schema:contentReferenceTime';
    public const VALUES = ['DateTimeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['CreativeWork' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1050'];
    public const SUPERSEDED_BY = null;
}
