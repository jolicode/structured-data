<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class AdverseOutcomeModel
{
    public const DESCRIPTION = 'A possible complication and/or side effect of this therapy. If it is known that an adverse outcome is serious (resulting in death, disability, or permanent damage; requiring hospitalization; or otherwise life-threatening or requiring immediate medical attention), tag it as a seriousAdverseOutcome instead.';
    public const LABEL = 'adverseOutcome';
    public const NAME = 'schema:adverseOutcome';
    public const VALUES = ['MedicalEntityModel' => 'Jolicode\SchemaOrg\Type\MedicalEntityModel'];
    public const TYPES = ['MedicalDevice' => 'Jolicode\SchemaOrg\Type\MedicalDeviceModel', 'TherapeuticProcedure' => 'Jolicode\SchemaOrg\Type\TherapeuticProcedureModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
