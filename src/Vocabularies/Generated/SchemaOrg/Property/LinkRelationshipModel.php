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

final class LinkRelationshipModel
{
    public const DESCRIPTION = 'Indicates the relationship type of a Web link.';
    public const LABEL = 'linkRelationship';
    public const NAME = 'schema:linkRelationship';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['LinkRole' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\LinkRoleModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1045'];
    public const SUPERSEDED_BY = null;
}
