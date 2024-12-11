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

final class SalaryUponCompletionModel
{
    public const DESCRIPTION = 'The expected salary upon completing the training.';
    public const LABEL = 'salaryUponCompletion';
    public const NAME = 'schema:salaryUponCompletion';
    public const VALUES = ['MonetaryAmountDistributionModel' => 'Jolicode\SchemaOrg\Type\MonetaryAmountDistributionModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalProgramModel'];
}
