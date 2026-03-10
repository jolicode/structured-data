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

final class HasMenuSectionModel
{
    public const DESCRIPTION = 'A subgrouping of the menu (by dishes, course, serving time period, etc.).';
    public const LABEL = 'hasMenuSection';
    public const NAME = 'schema:hasMenuSection';
    public const VALUES = ['MenuSectionModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MenuSectionModel'];
    public const TYPES = ['Menu' => 'Jolicode\Vocabularies\SchemaOrg\Type\MenuModel', 'MenuSection' => 'Jolicode\Vocabularies\SchemaOrg\Type\MenuSectionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
