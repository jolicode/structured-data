<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class LegislationAmendsModel
{
    public const DESCRIPTION = 'Another legislation that this legislation amends, introducing legal changes.';
    public const LABEL = 'legislationAmends';
    public const NAME = 'schema:legislationAmends';
    public const VALUES = ['LegislationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LegislationModel'];
    public const TYPES = ['Legislation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2698', 'https://op.europa.eu/en/web/eu-vocabularies/model/-/resource/dataset/eli'];
    public const SUPERSEDED_BY = null;
}
