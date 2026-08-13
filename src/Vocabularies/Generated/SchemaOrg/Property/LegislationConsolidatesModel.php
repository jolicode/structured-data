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

final class LegislationConsolidatesModel
{
    public const DESCRIPTION = 'Indicates another legislation taken into account in this consolidated legislation (which is usually the product of an editorial process that revises the legislation). This property should be used multiple times to refer to both the original version or the previous consolidated version, and to the legislations making the change.';
    public const LABEL = 'legislationConsolidates';
    public const NAME = 'schema:legislationConsolidates';
    public const VALUES = ['LegislationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LegislationModel'];
    public const TYPES = ['Legislation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1156', 'https://op.europa.eu/en/web/eu-vocabularies/model/-/resource/dataset/eli'];
    public const SUPERSEDED_BY = null;
}
