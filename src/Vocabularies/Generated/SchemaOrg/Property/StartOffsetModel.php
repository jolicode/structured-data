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

final class StartOffsetModel
{
    public const DESCRIPTION = 'The start time of the clip expressed as the number of seconds from the beginning of the work.';
    public const LABEL = 'startOffset';
    public const NAME = 'schema:startOffset';
    public const VALUES = ['HyperTocEntryModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HyperTocEntryModel', 'NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['Clip' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ClipModel', 'SeekToAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SeekToActionModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2021'];
    public const SUPERSEDED_BY = null;
}
