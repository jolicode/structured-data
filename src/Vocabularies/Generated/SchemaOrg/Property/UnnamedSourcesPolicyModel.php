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

final class UnnamedSourcesPolicyModel
{
    public const DESCRIPTION = 'For an [[Organization]] (typically a [[NewsMediaOrganization]]), a statement about policy on use of unnamed sources and the decision process required.';
    public const LABEL = 'unnamedSourcesPolicy';
    public const NAME = 'schema:unnamedSourcesPolicy';
    public const VALUES = ['CreativeWorkModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NewsMediaOrganizationModel', 'Organization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1525'];
    public const SUPERSEDED_BY = null;
}
