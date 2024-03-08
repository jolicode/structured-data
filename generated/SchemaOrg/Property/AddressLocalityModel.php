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

final class AddressLocalityModel
{
    public const DESCRIPTION = 'The locality in which the street address is, and which is in the region. For example, Mountain View.';
    public const LABEL = 'addressLocality';
    public const NAME = 'schema:addressLocality';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['PostalAddress' => 'SchemaOrg\\Type\\PostalAddressModel'];
}
