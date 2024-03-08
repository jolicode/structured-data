<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class InverseOfModel
{
    public const DESCRIPTION = 'Relates a property to a property that is its inverse. Inverse properties relate the same pairs of items to each other, but in reversed direction. For example, the \'alumni\' and \'alumniOf\' properties are inverseOf each other. Some properties don\'t have explicit inverses; in these situations RDFa and JSON-LD syntax for reverse properties can be used.';
    public const LABEL = 'inverseOf';
    public const NAME = 'schema:inverseOf';
    public const VALUES = ['PropertyModel' => 'SchemaOrg\Type\PropertyModel'];
    public const TYPES = ['Property' => 'SchemaOrg\Type\PropertyModel'];
}
