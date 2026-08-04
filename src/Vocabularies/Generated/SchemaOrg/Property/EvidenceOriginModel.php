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

final class EvidenceOriginModel
{
    public const DESCRIPTION = 'Source of the data used to formulate the guidance, e.g. RCT, consensus opinion, etc.';
    public const LABEL = 'evidenceOrigin';
    public const NAME = 'schema:evidenceOrigin';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalGuideline' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalGuidelineModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
