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

final class GreaterOrEqualModel
{
    public const DESCRIPTION = 'This ordering relation for qualitative values indicates that the subject is greater than or equal to the object.';
    public const LABEL = 'greaterOrEqual';
    public const NAME = 'schema:greaterOrEqual';
    public const VALUES = ['QualitativeValueModel' => 'SchemaOrg\Type\QualitativeValueModel'];
    public const TYPES = ['QualitativeValue' => 'SchemaOrg\Type\QualitativeValueModel'];
}
