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

final class EthicsPolicyModel
{
    public const DESCRIPTION = 'Statement about ethics policy, e.g. of a [[NewsMediaOrganization]] regarding journalistic and publishing practices, or of a [[Restaurant]], a page describing food source policies. In the case of a [[NewsMediaOrganization]], an ethicsPolicy is typically a statement describing the personal, organizational, and corporate standards of behavior expected by the organization.';
    public const LABEL = 'ethicsPolicy';
    public const NAME = 'schema:ethicsPolicy';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\NewsMediaOrganizationModel', 'Organization' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1525'];
    public const SUPERSEDED_BY = null;
}
