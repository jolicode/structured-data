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

final class DiversityStaffingReportModel
{
    public const DESCRIPTION = 'For an [[Organization]] (often but not necessarily a [[NewsMediaOrganization]]), a report on staffing diversity issues. In a news context this might be for example ASNE or RTDNA (US) reports, or self-reported.';
    public const LABEL = 'diversityStaffingReport';
    public const NAME = 'schema:diversityStaffingReport';
    public const VALUES = ['ArticleModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ArticleModel', 'URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\NewsMediaOrganizationModel', 'Organization' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1525'];
    public const SUPERSEDED_BY = null;
}
