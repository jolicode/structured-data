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

final class AppearanceModel
{
    public const DESCRIPTION = 'Indicates an occurrence of a [[Claim]] in some [[CreativeWork]].';
    public const LABEL = 'appearance';
    public const NAME = 'schema:appearance';
    public const VALUES = ['CreativeWorkModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const TYPES = ['Claim' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ClaimModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1828'];
    public const SUPERSEDED_BY = null;
}
