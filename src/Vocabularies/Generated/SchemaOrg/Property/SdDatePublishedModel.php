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

final class SdDatePublishedModel
{
    public const DESCRIPTION = 'Indicates the date on which the current structured data was generated / published. Typically used alongside [[sdPublisher]].';
    public const LABEL = 'sdDatePublished';
    public const NAME = 'schema:sdDatePublished';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1886'];
    public const SUPERSEDED_BY = null;
}
