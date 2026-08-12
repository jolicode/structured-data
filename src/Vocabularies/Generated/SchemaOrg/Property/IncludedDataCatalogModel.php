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

final class IncludedDataCatalogModel
{
    public const DESCRIPTION = 'A data catalog which contains this dataset (this property was previously \'catalog\', preferred name is now \'includedInDataCatalog\').';
    public const LABEL = 'includedDataCatalog';
    public const NAME = 'schema:includedDataCatalog';
    public const VALUES = ['DataCatalogModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DataCatalogModel'];
    public const TYPES = ['Dataset' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DatasetModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'includedInDataCatalog';
}
