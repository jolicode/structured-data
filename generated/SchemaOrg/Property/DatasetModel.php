<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class DatasetModel
{
    public const DESCRIPTION = 'A dataset contained in this catalog.';
    public const LABEL = 'dataset';
    public const NAME = 'schema:dataset';
    public const VALUES = ['DatasetModel' => 'SchemaOrg\\Type\\DatasetModel'];
    public const TYPES = ['DataCatalog' => 'SchemaOrg\\Type\\DataCatalogModel'];
}
