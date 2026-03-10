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

final class CvdNumVentUseModel
{
    public const DESCRIPTION = 'numventuse - MECHANICAL VENTILATORS IN USE: Total number of ventilators in use.';
    public const LABEL = 'cvdNumVentUse';
    public const NAME = 'schema:cvdNumVentUse';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['CDCPMDRecord' => 'Jolicode\Vocabularies\SchemaOrg\Type\CDCPMDRecordModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
