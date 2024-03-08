<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class AddressCountryModel
{
    public const DESCRIPTION = 'The country. For example, USA. You can also provide the two-letter [ISO 3166-1 alpha-2 country code](http://en.wikipedia.org/wiki/ISO_3166-1).';
    public const LABEL = 'addressCountry';
    public const NAME = 'schema:addressCountry';
    public const VALUES = ['CountryModel' => 'SchemaOrg\\Type\\CountryModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['DefinedRegion' => 'SchemaOrg\\Type\\DefinedRegionModel', 'GeoCoordinates' => 'SchemaOrg\\Type\\GeoCoordinatesModel', 'GeoShape' => 'SchemaOrg\\Type\\GeoShapeModel', 'PostalAddress' => 'SchemaOrg\\Type\\PostalAddressModel'];
}
