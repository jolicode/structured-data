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

final class LegislationDateModel
{
    public const DESCRIPTION = 'The date of adoption or signature of the legislation. This is the date at which the text is officially aknowledged to be a legislation, even though it might not even be published or in force.';
    public const LABEL = 'legislationDate';
    public const NAME = 'schema:legislationDate';
    public const VALUES = ['DateModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateModel'];
    public const TYPES = ['Legislation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1156', 'https://op.europa.eu/en/web/eu-vocabularies/model/-/resource/dataset/eli'];
    public const SUPERSEDED_BY = null;
}
