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

final class ProductGroupIDModel
{
    public const DESCRIPTION = 'Indicates a textual identifier for a ProductGroup.';
    public const LABEL = 'productGroupID';
    public const NAME = 'schema:productGroupID';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ProductGroup' => 'Jolicode\SchemaOrg\Type\ProductGroupModel'];
}
