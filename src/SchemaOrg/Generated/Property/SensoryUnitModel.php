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

final class SensoryUnitModel
{
    public const DESCRIPTION = 'The neurological pathway extension that inputs and sends information to the brain or spinal cord.';
    public const LABEL = 'sensoryUnit';
    public const NAME = 'schema:sensoryUnit';
    public const VALUES = ['AnatomicalStructureModel' => 'Jolicode\SchemaOrg\Type\AnatomicalStructureModel', 'SuperficialAnatomyModel' => 'Jolicode\SchemaOrg\Type\SuperficialAnatomyModel'];
    public const TYPES = ['Nerve' => 'Jolicode\SchemaOrg\Type\NerveModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
