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

final class TransmissionMethodModel
{
    public const DESCRIPTION = 'How the disease spreads, either as a route or vector, for example \'direct contact\', \'Aedes aegypti\', etc.';
    public const LABEL = 'transmissionMethod';
    public const NAME = 'schema:transmissionMethod';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['InfectiousDisease' => 'Jolicode\SchemaOrg\Type\InfectiousDiseaseModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
