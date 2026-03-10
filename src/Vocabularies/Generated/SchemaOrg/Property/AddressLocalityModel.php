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

final class AddressLocalityModel
{
    public const DESCRIPTION = 'The locality in which the street address is, and which is in the region. For example, Mountain View.';
    public const LABEL = 'addressLocality';
    public const NAME = 'schema:addressLocality';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PostalAddress' => 'Jolicode\Vocabularies\SchemaOrg\Type\PostalAddressModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
