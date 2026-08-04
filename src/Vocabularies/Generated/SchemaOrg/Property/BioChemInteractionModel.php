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

final class BioChemInteractionModel
{
    public const DESCRIPTION = 'A BioChemEntity that is known to interact with this item.';
    public const LABEL = 'bioChemInteraction';
    public const NAME = 'schema:bioChemInteraction';
    public const VALUES = ['BioChemEntityModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel'];
    public const TYPES = ['BioChemEntity' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BioChemEntityModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://www.bioschemas.org'];
    public const SUPERSEDED_BY = null;
}
