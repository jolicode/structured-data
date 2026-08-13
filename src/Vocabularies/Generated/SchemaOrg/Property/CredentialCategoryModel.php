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

final class CredentialCategoryModel
{
    public const DESCRIPTION = 'The category or type of credential being described, for example "degree”, “certificate”, “badge”, or more specific term.';
    public const LABEL = 'credentialCategory';
    public const NAME = 'schema:credentialCategory';
    public const VALUES = ['DefinedTermModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Credential' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CredentialModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1779'];
    public const SUPERSEDED_BY = null;
}
