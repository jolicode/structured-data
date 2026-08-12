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

final class IncludesHealthPlanFormularyModel
{
    public const DESCRIPTION = 'Formularies covered by this plan.';
    public const LABEL = 'includesHealthPlanFormulary';
    public const NAME = 'schema:includesHealthPlanFormulary';
    public const VALUES = ['HealthPlanFormularyModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HealthPlanFormularyModel'];
    public const TYPES = ['HealthInsurancePlan' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HealthInsurancePlanModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1062'];
    public const SUPERSEDED_BY = null;
}
