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

final class CvdNumVentModel
{
    public const DESCRIPTION = 'numvent - MECHANICAL VENTILATORS: Total number of ventilators available.';
    public const LABEL = 'cvdNumVent';
    public const NAME = 'schema:cvdNumVent';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['CDCPMDRecord' => 'Jolicode\Vocabularies\SchemaOrg\Type\CDCPMDRecordModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
