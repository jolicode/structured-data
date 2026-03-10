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

final class ErrorCodeModel
{
    public const DESCRIPTION = 'Application or platform dependant error code.';
    public const LABEL = 'errorCode';
    public const NAME = 'schema:errorCode';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\SchemaOrg\Type\DefinedTermModel', 'IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel', 'StatusEnumerationModel' => 'Jolicode\SchemaOrg\Type\StatusEnumerationModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Error' => 'Jolicode\SchemaOrg\Type\ErrorModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
