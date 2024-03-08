<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class SensoryUnitModel
{
    public const DESCRIPTION = 'The neurological pathway extension that inputs and sends information to the brain or spinal cord.';
    public const LABEL = 'sensoryUnit';
    public const NAME = 'schema:sensoryUnit';
    public const VALUES = ['AnatomicalStructureModel' => 'SchemaOrg\\Type\\AnatomicalStructureModel', 'SuperficialAnatomyModel' => 'SchemaOrg\\Type\\SuperficialAnatomyModel'];
    public const TYPES = ['Nerve' => 'SchemaOrg\\Type\\NerveModel'];
}
