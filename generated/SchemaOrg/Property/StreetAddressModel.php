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

final class StreetAddressModel
{
    public const DESCRIPTION = 'The street address. For example, 1600 Amphitheatre Pkwy.';
    public const LABEL = 'streetAddress';
    public const NAME = 'schema:streetAddress';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['PostalAddress' => 'SchemaOrg\\Type\\PostalAddressModel'];
}
