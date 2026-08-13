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

final class InterpretedAsClaimModel
{
    public const DESCRIPTION = 'Used to indicate a specific claim contained, implied, translated or refined from the content of a [[MediaObject]] or other [[CreativeWork]]. The interpreting party can be indicated using [[claimInterpreter]].';
    public const LABEL = 'interpretedAsClaim';
    public const NAME = 'schema:interpretedAsClaim';
    public const VALUES = ['ClaimModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ClaimModel'];
    public const TYPES = ['CreativeWork' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'MediaObject' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MediaObjectModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2450'];
    public const SUPERSEDED_BY = null;
}
