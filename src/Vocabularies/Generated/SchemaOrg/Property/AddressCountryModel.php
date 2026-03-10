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

final class AddressCountryModel
{
    public const DESCRIPTION = 'The country. Recommended to be in 2-letter [ISO 3166-1 alpha-2](http://en.wikipedia.org/wiki/ISO_3166-1) format, for example "US". For backward compatibility, a 3-letter [ISO 3166-1 alpha-3](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-3) country code such as "SGP" or a full country name such as "Singapore" can also be used.';
    public const LABEL = 'addressCountry';
    public const NAME = 'schema:addressCountry';
    public const VALUES = ['CountryModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CountryModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DefinedRegion' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedRegionModel', 'GeoCoordinates' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoCoordinatesModel', 'GeoShape' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoShapeModel', 'PostalAddress' => 'Jolicode\Vocabularies\SchemaOrg\Type\PostalAddressModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
