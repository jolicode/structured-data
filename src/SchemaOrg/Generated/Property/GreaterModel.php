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

final class GreaterModel
{
    public const DESCRIPTION = 'This ordering relation for qualitative values indicates that the subject is greater than the object.';
    public const LABEL = 'greater';
    public const NAME = 'schema:greater';
    public const VALUES = ['QualitativeValueModel' => 'Jolicode\SchemaOrg\Type\QualitativeValueModel'];
    public const TYPES = ['QualitativeValue' => 'Jolicode\SchemaOrg\Type\QualitativeValueModel'];
}
