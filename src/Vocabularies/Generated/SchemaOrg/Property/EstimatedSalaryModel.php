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

final class EstimatedSalaryModel
{
    public const DESCRIPTION = 'An estimated salary for a job posting or occupation, based on a variety of variables including, but not limited to industry, job title, and location. Estimated salaries  are often computed by outside organizations rather than the hiring organization, who may not have committed to the estimated value.';
    public const LABEL = 'estimatedSalary';
    public const NAME = 'schema:estimatedSalary';
    public const VALUES = ['MonetaryAmountDistributionModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountDistributionModel', 'MonetaryAmountModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel', 'NumberModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\JobPostingModel', 'Occupation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OccupationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
