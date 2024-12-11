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

final class LinkRelationshipModel
{
    public const DESCRIPTION = 'Indicates the relationship type of a Web link. ';
    public const LABEL = 'linkRelationship';
    public const NAME = 'schema:linkRelationship';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['LinkRole' => 'Jolicode\SchemaOrg\Type\LinkRoleModel'];
}
