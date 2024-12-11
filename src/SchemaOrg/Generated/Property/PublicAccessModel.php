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

final class PublicAccessModel
{
    public const DESCRIPTION = 'A flag to signal that the [[Place]] is open to public visitors.  If this property is omitted there is no assumed default boolean value';
    public const LABEL = 'publicAccess';
    public const NAME = 'schema:publicAccess';
    public const VALUES = ['BooleanModel' => 'Jolicode\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['Place' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
}
