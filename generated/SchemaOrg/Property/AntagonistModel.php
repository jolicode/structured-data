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

final class AntagonistModel
{
    public const DESCRIPTION = 'The muscle whose action counteracts the specified muscle.';
    public const LABEL = 'antagonist';
    public const NAME = 'schema:antagonist';
    public const VALUES = ['MuscleModel' => 'SchemaOrg\\Type\\MuscleModel'];
    public const TYPES = ['Muscle' => 'SchemaOrg\\Type\\MuscleModel'];
}
