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

final class TermsOfServiceModel
{
    public const DESCRIPTION = 'Human-readable terms of service documentation.';
    public const LABEL = 'termsOfService';
    public const NAME = 'schema:termsOfService';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Service' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1423'];
    public const SUPERSEDED_BY = null;
}
