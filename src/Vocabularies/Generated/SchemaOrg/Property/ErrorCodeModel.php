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

final class ErrorCodeModel
{
    public const DESCRIPTION = 'Application or platform dependant error code.';
    public const LABEL = 'errorCode';
    public const NAME = 'schema:errorCode';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedTermModel', 'IntegerModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\IntegerModel', 'StatusEnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\StatusEnumerationModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Error' => 'Jolicode\Vocabularies\SchemaOrg\Type\ErrorModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
