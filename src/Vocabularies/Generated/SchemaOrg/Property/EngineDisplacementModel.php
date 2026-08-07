<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class EngineDisplacementModel
{
    public const DESCRIPTION = 'The volume swept by all of the pistons inside the cylinders of an internal combustion engine in a single movement. \n\nTypical unit code(s): CMQ for cubic centimeter, LTR for liters, INQ for cubic inches\n* Note 1: You can link to information about how the given value has been determined using the [[valueReference]] property.\n* Note 2: You can use [[minValue]] and [[maxValue]] to indicate ranges.';
    public const LABEL = 'engineDisplacement';
    public const NAME = 'schema:engineDisplacement';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['EngineSpecification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EngineSpecificationModel'];
    public const IS_PART_OF = ['https://auto.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
