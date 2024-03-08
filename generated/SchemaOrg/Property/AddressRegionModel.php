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

final class AddressRegionModel
{
    public const DESCRIPTION = 'The region in which the locality is, and which is in the country. For example, California or another appropriate first-level [Administrative division](https://en.wikipedia.org/wiki/List_of_administrative_divisions_by_country).';
    public const LABEL = 'addressRegion';
    public const NAME = 'schema:addressRegion';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['DefinedRegion' => 'SchemaOrg\\Type\\DefinedRegionModel', 'PostalAddress' => 'SchemaOrg\\Type\\PostalAddressModel'];
}
