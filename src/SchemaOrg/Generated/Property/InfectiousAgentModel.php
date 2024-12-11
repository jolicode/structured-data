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

final class InfectiousAgentModel
{
    public const DESCRIPTION = 'The actual infectious agent, such as a specific bacterium.';
    public const LABEL = 'infectiousAgent';
    public const NAME = 'schema:infectiousAgent';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['InfectiousDisease' => 'Jolicode\SchemaOrg\Type\InfectiousDiseaseModel'];
}
