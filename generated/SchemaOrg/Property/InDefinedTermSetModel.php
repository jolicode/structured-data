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

final class InDefinedTermSetModel
{
    public const DESCRIPTION = 'A [[DefinedTermSet]] that contains this term.';
    public const LABEL = 'inDefinedTermSet';
    public const NAME = 'schema:inDefinedTermSet';
    public const VALUES = ['DefinedTermSetModel' => 'SchemaOrg\Type\DefinedTermSetModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['DefinedTerm' => 'SchemaOrg\Type\DefinedTermModel'];
}
