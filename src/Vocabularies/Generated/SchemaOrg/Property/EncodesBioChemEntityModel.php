<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class EncodesBioChemEntityModel
{
    public const DESCRIPTION = 'Another BioChemEntity encoded by this one.';
    public const LABEL = 'encodesBioChemEntity';
    public const NAME = 'schema:encodesBioChemEntity';
    public const VALUES = ['BioChemEntityModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BioChemEntityModel'];
    public const TYPES = ['Gene' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeneModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
