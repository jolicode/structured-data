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

final class IsLocatedInSubcellularLocationModel
{
    public const DESCRIPTION = 'Subcellular location where this BioChemEntity is located; please use PropertyValue if you want to include any evidence.';
    public const LABEL = 'isLocatedInSubcellularLocation';
    public const NAME = 'schema:isLocatedInSubcellularLocation';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedTermModel', 'PropertyValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyValueModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['BioChemEntity' => 'Jolicode\Vocabularies\SchemaOrg\Type\BioChemEntityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
