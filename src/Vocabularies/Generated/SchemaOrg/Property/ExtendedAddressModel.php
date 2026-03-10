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

final class ExtendedAddressModel
{
    public const DESCRIPTION = 'An address extension such as an apartment number, C/O or alternative name.';
    public const LABEL = 'extendedAddress';
    public const NAME = 'schema:extendedAddress';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PostalAddress' => 'Jolicode\Vocabularies\SchemaOrg\Type\PostalAddressModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
