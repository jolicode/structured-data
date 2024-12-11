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

final class CountryOfLastProcessingModel
{
    public const DESCRIPTION = 'The place where the item (typically [[Product]]) was last processed and tested before importation.';
    public const LABEL = 'countryOfLastProcessing';
    public const NAME = 'schema:countryOfLastProcessing';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Product' => 'Jolicode\SchemaOrg\Type\ProductModel'];
}
