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

final class EvidenceLevelModel
{
    public const DESCRIPTION = 'Strength of evidence of the data used to formulate the guideline (enumerated).';
    public const LABEL = 'evidenceLevel';
    public const NAME = 'schema:evidenceLevel';
    public const VALUES = ['MedicalEvidenceLevelModel' => 'Jolicode\SchemaOrg\Type\MedicalEvidenceLevelModel'];
    public const TYPES = ['MedicalGuideline' => 'Jolicode\SchemaOrg\Type\MedicalGuidelineModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
