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

final class AcquireLicensePageModel
{
    public const DESCRIPTION = 'Indicates a page documenting how licenses can be purchased or otherwise acquired, for the current item.';
    public const LABEL = 'acquireLicensePage';
    public const NAME = 'schema:acquireLicensePage';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2454'];
    public const SUPERSEDED_BY = null;
}
