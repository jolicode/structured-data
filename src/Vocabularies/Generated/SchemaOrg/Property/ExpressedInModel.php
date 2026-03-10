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

final class ExpressedInModel
{
    public const DESCRIPTION = 'Tissue, organ, biological sample, etc in which activity of this gene has been observed experimentally. For example brain, digestive system.';
    public const LABEL = 'expressedIn';
    public const NAME = 'schema:expressedIn';
    public const VALUES = ['AnatomicalStructureModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystemModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AnatomicalSystemModel', 'BioChemEntityModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BioChemEntityModel', 'DefinedTermModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedTermModel'];
    public const TYPES = ['Gene' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeneModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
