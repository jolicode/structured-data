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

final class PatternModel
{
    public const DESCRIPTION = 'A pattern that something has, for example \'polka dot\', \'striped\', \'Canadian flag\'. Values are typically expressed as text, although links to controlled value schemes are also supported.';
    public const LABEL = 'pattern';
    public const NAME = 'schema:pattern';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\\Type\\DefinedTermModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel', 'Product' => 'SchemaOrg\\Type\\ProductModel'];
}
