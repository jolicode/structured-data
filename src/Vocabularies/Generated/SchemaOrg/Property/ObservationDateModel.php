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

final class ObservationDateModel
{
    public const DESCRIPTION = 'The observationDate of an [[Observation]].';
    public const LABEL = 'observationDate';
    public const NAME = 'schema:observationDate';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Observation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ObservationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2291'];
    public const SUPERSEDED_BY = null;
}
