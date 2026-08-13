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

final class HasCredentialModel
{
    public const DESCRIPTION = 'A credential awarded to the Person or Organization.';
    public const LABEL = 'hasCredential';
    public const NAME = 'schema:hasCredential';
    public const VALUES = ['CredentialModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CredentialModel'];
    public const TYPES = ['Organization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Person' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2289'];
    public const SUPERSEDED_BY = null;
}
