<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class TrainingSalaryModel
{
    public const DESCRIPTION = 'The estimated salary earned while in the program.';
    public const LABEL = 'trainingSalary';
    public const NAME = 'schema:trainingSalary';
    public const VALUES = ['MonetaryAmountDistributionModel' => 'SchemaOrg\\Type\\MonetaryAmountDistributionModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'SchemaOrg\\Type\\EducationalOccupationalProgramModel', 'WorkBasedProgram' => 'SchemaOrg\\Type\\WorkBasedProgramModel'];
}
