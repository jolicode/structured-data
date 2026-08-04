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

final class Sha256Model
{
    public const DESCRIPTION = 'The [SHA-2](https://en.wikipedia.org/wiki/SHA-2) SHA256 hash of the content of the item. For example, a zero-length input has value \'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855\'.';
    public const LABEL = 'sha256';
    public const NAME = 'schema:sha256';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MediaObject' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MediaObjectModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2450'];
    public const SUPERSEDED_BY = null;
}
