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

final class PostalCodeRangeModel
{
    public const DESCRIPTION = 'A defined range of postal codes.';
    public const LABEL = 'postalCodeRange';
    public const NAME = 'schema:postalCodeRange';
    public const VALUES = ['PostalCodeRangeSpecificationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PostalCodeRangeSpecificationModel'];
    public const TYPES = ['DefinedRegion' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedRegionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
