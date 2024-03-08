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

final class CollectionSizeModel
{
    public const DESCRIPTION = 'The number of items in the [[Collection]].';
    public const LABEL = 'collectionSize';
    public const NAME = 'schema:collectionSize';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\\Type\\IntegerModel'];
    public const TYPES = ['Collection' => 'SchemaOrg\\Type\\CollectionModel'];
}
