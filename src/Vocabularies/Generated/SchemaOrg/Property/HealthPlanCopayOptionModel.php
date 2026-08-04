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

final class HealthPlanCopayOptionModel
{
    public const DESCRIPTION = 'Whether the copay is before or after deductible, etc. TODO: Is this a closed set?';
    public const LABEL = 'healthPlanCopayOption';
    public const NAME = 'schema:healthPlanCopayOption';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HealthPlanCostSharingSpecification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\HealthPlanCostSharingSpecificationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1062'];
    public const SUPERSEDED_BY = null;
}
