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

final class AdverseOutcomeModel
{
    public const DESCRIPTION = 'A possible complication and/or side effect of this therapy. If it is known that an adverse outcome is serious (resulting in death, disability, or permanent damage; requiring hospitalization; or otherwise life-threatening or requiring immediate medical attention), tag it as a seriousAdverseOutcome instead.';
    public const LABEL = 'adverseOutcome';
    public const NAME = 'schema:adverseOutcome';
    public const VALUES = ['MedicalEntityModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalEntityModel'];
    public const TYPES = ['MedicalDevice' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalDeviceModel', 'TherapeuticProcedure' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TherapeuticProcedureModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
