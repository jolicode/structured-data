<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class InChIKeyModel
{
    public const DESCRIPTION = 'InChIKey is a hashed version of the full InChI (using the SHA-256 algorithm).';
    public const LABEL = 'inChIKey';
    public const NAME = 'schema:inChIKey';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MolecularEntity' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MolecularEntityModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://www.bioschemas.org/MolecularEntity'];
    public const SUPERSEDED_BY = null;
}
