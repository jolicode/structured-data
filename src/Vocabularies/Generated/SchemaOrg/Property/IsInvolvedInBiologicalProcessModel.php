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

final class IsInvolvedInBiologicalProcessModel
{
    public const DESCRIPTION = 'Biological process this BioChemEntity is involved in; please use PropertyValue if you want to include any evidence.';
    public const LABEL = 'isInvolvedInBiologicalProcess';
    public const NAME = 'schema:isInvolvedInBiologicalProcess';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel', 'PropertyValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PropertyValueModel', 'URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['BioChemEntity' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
