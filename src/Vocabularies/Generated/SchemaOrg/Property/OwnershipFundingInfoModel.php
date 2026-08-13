<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class OwnershipFundingInfoModel
{
    public const DESCRIPTION = 'For an [[Organization]] (often but not necessarily a [[NewsMediaOrganization]]), a description of organizational ownership structure; funding and grants. In a news/media setting, this is with particular reference to editorial independence.   Note that the [[funder]] is also available and can be used to make basic funder information machine-readable.';
    public const LABEL = 'ownershipFundingInfo';
    public const NAME = 'schema:ownershipFundingInfo';
    public const VALUES = ['AboutPageModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AboutPageModel', 'CreativeWorkModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NewsMediaOrganizationModel', 'Organization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1525'];
    public const SUPERSEDED_BY = null;
}
