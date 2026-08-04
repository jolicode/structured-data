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

final class TributaryModel
{
    public const DESCRIPTION = 'The anatomical or organ system that the vein flows into; a larger structure that the vein connects to.';
    public const LABEL = 'tributary';
    public const NAME = 'schema:tributary';
    public const VALUES = ['AnatomicalStructureModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AnatomicalStructureModel'];
    public const TYPES = ['Vein' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\VeinModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
