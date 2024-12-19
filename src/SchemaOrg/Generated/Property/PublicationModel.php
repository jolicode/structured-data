<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class PublicationModel
{
    public const DESCRIPTION = 'A publication event associated with the item.';
    public const LABEL = 'publication';
    public const NAME = 'schema:publication';
    public const VALUES = ['PublicationEventModel' => 'Jolicode\SchemaOrg\Type\PublicationEventModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
