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

final class DomainIncludesModel
{
    public const DESCRIPTION = 'Relates a property to a class that is (one of) the type(s) the property is expected to be used on.';
    public const LABEL = 'domainIncludes';
    public const NAME = 'schema:domainIncludes';
    public const VALUES = ['ClassModel' => 'Jolicode\SchemaOrg\Type\ClassModel'];
    public const TYPES = ['Property' => 'Jolicode\SchemaOrg\Type\PropertyModel'];
}
