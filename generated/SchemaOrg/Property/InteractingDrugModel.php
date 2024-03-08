<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class InteractingDrugModel
{
    public const DESCRIPTION = 'Another drug that is known to interact with this drug in a way that impacts the effect of this drug or causes a risk to the patient. Note: disease interactions are typically captured as contraindications.';
    public const LABEL = 'interactingDrug';
    public const NAME = 'schema:interactingDrug';
    public const VALUES = ['DrugModel' => 'SchemaOrg\Type\DrugModel'];
    public const TYPES = ['Drug' => 'SchemaOrg\Type\DrugModel'];
}
