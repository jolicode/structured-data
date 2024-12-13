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

final class SeriousAdverseOutcomeModel
{
    public const DESCRIPTION = 'A possible serious complication and/or serious side effect of this therapy. Serious adverse outcomes include those that are life-threatening; result in death, disability, or permanent damage; require hospitalization or prolong existing hospitalization; cause congenital anomalies or birth defects; or jeopardize the patient and may require medical or surgical intervention to prevent one of the outcomes in this definition.';
    public const LABEL = 'seriousAdverseOutcome';
    public const NAME = 'schema:seriousAdverseOutcome';
    public const VALUES = ['MedicalEntityModel' => 'Jolicode\SchemaOrg\Type\MedicalEntityModel'];
    public const TYPES = ['MedicalDevice' => 'Jolicode\SchemaOrg\Type\MedicalDeviceModel', 'MedicalTherapy' => 'Jolicode\SchemaOrg\Type\MedicalTherapyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
