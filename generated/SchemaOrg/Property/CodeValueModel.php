<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class CodeValueModel
{
    public const DESCRIPTION = 'A short textual code that uniquely identifies the value.';
    public const LABEL = 'codeValue';
    public const NAME = 'schema:codeValue';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['CategoryCode' => 'SchemaOrg\Type\CategoryCodeModel', 'MedicalCode' => 'SchemaOrg\Type\MedicalCodeModel'];
}
