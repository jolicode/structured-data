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

final class ConsumerNoticeModel
{
    public const DESCRIPTION = 'A consumer notice, such as a safety warning or mandatory information, related to the product.';
    public const LABEL = 'consumerNotice';
    public const NAME = 'schema:consumerNotice';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'TextObjectModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextObjectModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel', 'WebContentModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['Product' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/4878'];
    public const SUPERSEDED_BY = null;
}
