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

final class LegislationTypeModel
{
    public const DESCRIPTION = 'The type of the legislation. Examples of values are "law", "act", "directive", "decree", "regulation", "statutory instrument", "loi organique", "règlement grand-ducal", etc., depending on the country.';
    public const LABEL = 'legislationType';
    public const NAME = 'schema:legislationType';
    public const VALUES = ['CategoryCodeModel' => 'SchemaOrg\\Type\\CategoryCodeModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Legislation' => 'SchemaOrg\\Type\\LegislationModel'];
}
