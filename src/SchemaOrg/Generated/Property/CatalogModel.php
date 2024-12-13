<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class CatalogModel
{
    public const DESCRIPTION = 'A data catalog which contains this dataset.';
    public const LABEL = 'catalog';
    public const NAME = 'schema:catalog';
    public const VALUES = ['DataCatalogModel' => 'Jolicode\SchemaOrg\Type\DataCatalogModel'];
    public const TYPES = ['Dataset' => 'Jolicode\SchemaOrg\Type\DatasetModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
