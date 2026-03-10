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

final class ContentTypeModel
{
    public const DESCRIPTION = 'The supported content type(s) for an EntryPoint response.';
    public const LABEL = 'contentType';
    public const NAME = 'schema:contentType';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['EntryPoint' => 'Jolicode\Vocabularies\SchemaOrg\Type\EntryPointModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
