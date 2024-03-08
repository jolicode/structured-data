<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ValueAddedTaxIncludedModel
{
    public const DESCRIPTION = 'Specifies whether the applicable value-added tax (VAT) is included in the price specification or not.';
    public const LABEL = 'valueAddedTaxIncluded';
    public const NAME = 'schema:valueAddedTaxIncluded';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['PriceSpecification' => 'SchemaOrg\Type\PriceSpecificationModel'];
}
