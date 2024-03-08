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

final class SameAsModel
{
    public const DESCRIPTION = 'URL of a reference Web page that unambiguously indicates the item\'s identity. E.g. the URL of the item\'s Wikipedia page, Wikidata entry, or official website.';
    public const LABEL = 'sameAs';
    public const NAME = 'schema:sameAs';
    public const VALUES = ['URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['Thing' => 'SchemaOrg\\Type\\ThingModel'];
}
