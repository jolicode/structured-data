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

final class AbstractModel
{
    public const DESCRIPTION = 'An abstract is a short description that summarizes a [[CreativeWork]].';
    public const LABEL = 'abstract';
    public const NAME = 'schema:abstract';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/276'];
    public const SUPERSEDED_BY = null;
}
