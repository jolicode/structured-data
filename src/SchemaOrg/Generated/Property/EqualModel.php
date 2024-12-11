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

final class EqualModel
{
    public const DESCRIPTION = 'This ordering relation for qualitative values indicates that the subject is equal to the object.';
    public const LABEL = 'equal';
    public const NAME = 'schema:equal';
    public const VALUES = ['QualitativeValueModel' => 'Jolicode\SchemaOrg\Type\QualitativeValueModel'];
    public const TYPES = ['QualitativeValue' => 'Jolicode\SchemaOrg\Type\QualitativeValueModel'];
}
