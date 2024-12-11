<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ExpressedInModel
{
    public const DESCRIPTION = 'Tissue, organ, biological sample, etc in which activity of this gene has been observed experimentally. For example brain, digestive system.';
    public const LABEL = 'expressedIn';
    public const NAME = 'schema:expressedIn';
    public const VALUES = ['AnatomicalStructureModel' => 'Jolicode\SchemaOrg\Type\AnatomicalStructureModel', 'AnatomicalSystemModel' => 'Jolicode\SchemaOrg\Type\AnatomicalSystemModel', 'BioChemEntityModel' => 'Jolicode\SchemaOrg\Type\BioChemEntityModel', 'DefinedTermModel' => 'Jolicode\SchemaOrg\Type\DefinedTermModel'];
    public const TYPES = ['Gene' => 'Jolicode\SchemaOrg\Type\GeneModel'];
}
