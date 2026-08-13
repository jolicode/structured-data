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

final class LegislationLegalForceModel
{
    public const DESCRIPTION = 'Whether the legislation is currently in force, not in force, or partially in force.';
    public const LABEL = 'legislationLegalForce';
    public const NAME = 'schema:legislationLegalForce';
    public const VALUES = ['LegalForceStatusModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LegalForceStatusModel'];
    public const TYPES = ['Legislation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1156', 'https://op.europa.eu/en/web/eu-vocabularies/model/-/resource/dataset/eli'];
    public const SUPERSEDED_BY = null;
}
