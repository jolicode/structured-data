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

final class SupersededByModel
{
    public const DESCRIPTION = 'Relates a term (i.e. a property, class or enumeration) to one that supersedes it.';
    public const LABEL = 'supersededBy';
    public const NAME = 'schema:supersededBy';
    public const VALUES = ['ClassModel' => 'SchemaOrg\\Type\\ClassModel', 'EnumerationModel' => 'SchemaOrg\\Type\\EnumerationModel', 'PropertyModel' => 'SchemaOrg\\Type\\PropertyModel'];
    public const TYPES = ['Class' => 'SchemaOrg\\Type\\ClassModel', 'Enumeration' => 'SchemaOrg\\Type\\EnumerationModel', 'Property' => 'SchemaOrg\\Type\\PropertyModel'];
}
