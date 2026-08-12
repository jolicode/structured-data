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

final class BroadcastSignalModulationModel
{
    public const DESCRIPTION = 'The modulation (e.g. FM, AM, etc) used by a particular broadcast service.';
    public const LABEL = 'broadcastSignalModulation';
    public const NAME = 'schema:broadcastSignalModulation';
    public const VALUES = ['QualitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastFrequencySpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BroadcastFrequencySpecificationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2111'];
    public const SUPERSEDED_BY = null;
}
