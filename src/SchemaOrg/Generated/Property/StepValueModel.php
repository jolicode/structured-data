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

final class StepValueModel
{
    public const DESCRIPTION = 'The stepValue attribute indicates the granularity that is expected (and required) of the value in a PropertyValueSpecification.';
    public const LABEL = 'stepValue';
    public const NAME = 'schema:stepValue';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['PropertyValueSpecification' => 'Jolicode\SchemaOrg\Type\PropertyValueSpecificationModel'];
}
