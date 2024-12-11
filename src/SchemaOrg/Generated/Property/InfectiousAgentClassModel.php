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

final class InfectiousAgentClassModel
{
    public const DESCRIPTION = 'The class of infectious agent (bacteria, prion, etc.) that causes the disease.';
    public const LABEL = 'infectiousAgentClass';
    public const NAME = 'schema:infectiousAgentClass';
    public const VALUES = ['InfectiousAgentClassModel' => 'Jolicode\SchemaOrg\Type\InfectiousAgentClassModel'];
    public const TYPES = ['InfectiousDisease' => 'Jolicode\SchemaOrg\Type\InfectiousDiseaseModel'];
}
