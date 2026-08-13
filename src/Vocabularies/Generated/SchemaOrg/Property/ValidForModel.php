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

final class ValidForModel
{
    public const DESCRIPTION = 'The duration of validity of a permit or similar thing.';
    public const LABEL = 'validFor';
    public const NAME = 'schema:validFor';
    public const VALUES = ['DurationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DurationModel'];
    public const TYPES = ['Credential' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CredentialModel', 'Permit' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PermitModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1779'];
    public const SUPERSEDED_BY = null;
}
