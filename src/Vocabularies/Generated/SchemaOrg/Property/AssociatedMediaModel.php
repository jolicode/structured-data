<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class AssociatedMediaModel
{
    public const DESCRIPTION = 'A media object that encodes this CreativeWork. This property is a synonym for encoding.';
    public const LABEL = 'associatedMedia';
    public const NAME = 'schema:associatedMedia';
    public const VALUES = ['MediaObjectModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaObjectModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'HyperTocEntry' => 'Jolicode\Vocabularies\SchemaOrg\Type\HyperTocEntryModel', 'HyperToc' => 'Jolicode\Vocabularies\SchemaOrg\Type\HyperTocModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
