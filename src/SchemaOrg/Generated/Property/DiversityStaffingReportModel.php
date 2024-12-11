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

final class DiversityStaffingReportModel
{
    public const DESCRIPTION = 'For an [[Organization]] (often but not necessarily a [[NewsMediaOrganization]]), a report on staffing diversity issues. In a news context this might be for example ASNE or RTDNA (US) reports, or self-reported.';
    public const LABEL = 'diversityStaffingReport';
    public const NAME = 'schema:diversityStaffingReport';
    public const VALUES = ['ArticleModel' => 'Jolicode\SchemaOrg\Type\ArticleModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'Jolicode\SchemaOrg\Type\NewsMediaOrganizationModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
}
