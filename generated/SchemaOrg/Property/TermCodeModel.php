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

final class TermCodeModel
{
    public const DESCRIPTION = 'A code that identifies this [[DefinedTerm]] within a [[DefinedTermSet]]';
    public const LABEL = 'termCode';
    public const NAME = 'schema:termCode';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['DefinedTerm' => 'SchemaOrg\Type\DefinedTermModel'];
}
