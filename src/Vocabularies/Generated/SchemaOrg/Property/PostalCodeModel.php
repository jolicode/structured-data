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

final class PostalCodeModel
{
    public const DESCRIPTION = 'The postal code. For example, 94043.';
    public const LABEL = 'postalCode';
    public const NAME = 'schema:postalCode';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DefinedRegion' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedRegionModel', 'GeoCoordinates' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoCoordinatesModel', 'GeoShape' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoShapeModel', 'PostalAddress' => 'Jolicode\Vocabularies\SchemaOrg\Type\PostalAddressModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
