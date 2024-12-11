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

final class PostOfficeBoxNumberModel
{
    public const DESCRIPTION = 'The post office box number for PO box addresses.';
    public const LABEL = 'postOfficeBoxNumber';
    public const NAME = 'schema:postOfficeBoxNumber';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PostalAddress' => 'Jolicode\SchemaOrg\Type\PostalAddressModel'];
}
