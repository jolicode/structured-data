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

final class AlternateNameModel
{
    public const DESCRIPTION = 'An alias for the item.';
    public const LABEL = 'alternateName';
    public const NAME = 'schema:alternateName';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Thing' => 'Jolicode\SchemaOrg\Type\ThingModel'];
}
