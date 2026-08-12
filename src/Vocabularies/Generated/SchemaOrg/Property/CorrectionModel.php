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

final class CorrectionModel
{
    public const DESCRIPTION = 'Indicates a correction to a [[CreativeWork]], either via a [[CorrectionComment]], textually or in another document.';
    public const LABEL = 'correction';
    public const NAME = 'schema:correction';
    public const VALUES = ['CorrectionCommentModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CorrectionCommentModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1950'];
    public const SUPERSEDED_BY = null;
}
