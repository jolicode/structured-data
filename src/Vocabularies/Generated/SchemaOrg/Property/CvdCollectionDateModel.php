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

final class CvdCollectionDateModel
{
    public const DESCRIPTION = 'collectiondate - Date for which patient counts are reported.';
    public const LABEL = 'cvdCollectionDate';
    public const NAME = 'schema:cvdCollectionDate';
    public const VALUES = ['DateTimeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CDCPMDRecord' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CDCPMDRecordModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2521'];
    public const SUPERSEDED_BY = null;
}
