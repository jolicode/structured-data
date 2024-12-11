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

final class NerveModel
{
    public const DESCRIPTION = 'The underlying innervation associated with the muscle.';
    public const LABEL = 'nerve';
    public const NAME = 'schema:nerve';
    public const VALUES = ['NerveModel' => 'Jolicode\SchemaOrg\Type\NerveModel'];
    public const TYPES = ['Muscle' => 'Jolicode\SchemaOrg\Type\MuscleModel'];
}
