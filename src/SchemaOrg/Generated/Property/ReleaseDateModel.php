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

final class ReleaseDateModel
{
    public const DESCRIPTION = 'The release date of a product or product model. This can be used to distinguish the exact variant of a product.';
    public const LABEL = 'releaseDate';
    public const NAME = 'schema:releaseDate';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel'];
    public const TYPES = ['Product' => 'Jolicode\SchemaOrg\Type\ProductModel'];
}
