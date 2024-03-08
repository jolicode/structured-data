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

final class ClinicalPharmacologyModel
{
    public const DESCRIPTION = 'Description of the absorption and elimination of drugs, including their concentration (pharmacokinetics, pK) and biological effects (pharmacodynamics, pD).';
    public const LABEL = 'clinicalPharmacology';
    public const NAME = 'schema:clinicalPharmacology';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Drug' => 'SchemaOrg\Type\DrugModel'];
}
