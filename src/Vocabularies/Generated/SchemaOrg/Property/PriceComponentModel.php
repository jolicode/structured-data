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

final class PriceComponentModel
{
    public const DESCRIPTION = 'This property links to all [[UnitPriceSpecification]] nodes that apply in parallel for the [[CompoundPriceSpecification]] node.';
    public const LABEL = 'priceComponent';
    public const NAME = 'schema:priceComponent';
    public const VALUES = ['PriceSpecificationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PriceSpecificationModel'];
    public const TYPES = ['CompoundPriceSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\CompoundPriceSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
