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

final class ApplicationCategoryModel
{
    public const DESCRIPTION = 'Type of software application, e.g. \'Game, Multimedia\'.';
    public const LABEL = 'applicationCategory';
    public const NAME = 'schema:applicationCategory';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['SoftwareApplication' => 'Jolicode\Vocabularies\SchemaOrg\Type\SoftwareApplicationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
