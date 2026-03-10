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

final class DocumentationModel
{
    public const DESCRIPTION = 'Further documentation describing the Web API in more detail.';
    public const LABEL = 'documentation';
    public const NAME = 'schema:documentation';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['WebAPI' => 'Jolicode\Vocabularies\SchemaOrg\Type\WebAPIModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
