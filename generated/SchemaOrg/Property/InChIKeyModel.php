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

final class InChIKeyModel
{
    public const DESCRIPTION = 'InChIKey is a hashed version of the full InChI (using the SHA-256 algorithm).';
    public const LABEL = 'inChIKey';
    public const NAME = 'schema:inChIKey';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['MolecularEntity' => 'SchemaOrg\Type\MolecularEntityModel'];
}
