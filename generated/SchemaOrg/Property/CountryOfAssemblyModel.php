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

final class CountryOfAssemblyModel
{
    public const DESCRIPTION = 'The place where the product was assembled.';
    public const LABEL = 'countryOfAssembly';
    public const NAME = 'schema:countryOfAssembly';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Product' => 'SchemaOrg\Type\ProductModel'];
}
