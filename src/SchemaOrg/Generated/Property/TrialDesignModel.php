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

final class TrialDesignModel
{
    public const DESCRIPTION = 'Specifics about the trial design (enumerated).';
    public const LABEL = 'trialDesign';
    public const NAME = 'schema:trialDesign';
    public const VALUES = ['MedicalTrialDesignModel' => 'Jolicode\SchemaOrg\Type\MedicalTrialDesignModel'];
    public const TYPES = ['MedicalTrial' => 'Jolicode\SchemaOrg\Type\MedicalTrialModel'];
}
