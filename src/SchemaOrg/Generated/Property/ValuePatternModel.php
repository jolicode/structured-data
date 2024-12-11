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

final class ValuePatternModel
{
    public const DESCRIPTION = 'Specifies a regular expression for testing literal values according to the HTML spec.';
    public const LABEL = 'valuePattern';
    public const NAME = 'schema:valuePattern';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PropertyValueSpecification' => 'Jolicode\SchemaOrg\Type\PropertyValueSpecificationModel'];
}
