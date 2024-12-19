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

final class IsSimilarToModel
{
    public const DESCRIPTION = 'A pointer to another, functionally similar product (or multiple products).';
    public const LABEL = 'isSimilarTo';
    public const NAME = 'schema:isSimilarTo';
    public const VALUES = ['ProductModel' => 'Jolicode\SchemaOrg\Type\ProductModel', 'ServiceModel' => 'Jolicode\SchemaOrg\Type\ServiceModel'];
    public const TYPES = ['Product' => 'Jolicode\SchemaOrg\Type\ProductModel', 'Service' => 'Jolicode\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
