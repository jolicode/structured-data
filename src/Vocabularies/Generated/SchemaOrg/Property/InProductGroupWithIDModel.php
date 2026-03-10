<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class InProductGroupWithIDModel
{
    public const DESCRIPTION = 'Indicates the [[productGroupID]] for a [[ProductGroup]] that this product [[isVariantOf]].';
    public const LABEL = 'inProductGroupWithID';
    public const NAME = 'schema:inProductGroupWithID';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
