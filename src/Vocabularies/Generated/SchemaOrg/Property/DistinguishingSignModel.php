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

final class DistinguishingSignModel
{
    public const DESCRIPTION = 'One of a set of signs and symptoms that can be used to distinguish this diagnosis from others in the differential diagnosis.';
    public const LABEL = 'distinguishingSign';
    public const NAME = 'schema:distinguishingSign';
    public const VALUES = ['MedicalSignOrSymptomModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalSignOrSymptomModel'];
    public const TYPES = ['DDxElement' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DDxElementModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
