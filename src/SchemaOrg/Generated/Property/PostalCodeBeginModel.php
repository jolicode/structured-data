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

final class PostalCodeBeginModel
{
    public const DESCRIPTION = 'First postal code in a range (included).';
    public const LABEL = 'postalCodeBegin';
    public const NAME = 'schema:postalCodeBegin';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PostalCodeRangeSpecification' => 'Jolicode\SchemaOrg\Type\PostalCodeRangeSpecificationModel'];
}
