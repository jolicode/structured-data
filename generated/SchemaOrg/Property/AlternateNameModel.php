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

final class AlternateNameModel
{
    public const DESCRIPTION = 'An alias for the item.';
    public const LABEL = 'alternateName';
    public const NAME = 'schema:alternateName';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Thing' => 'SchemaOrg\\Type\\ThingModel'];
}
