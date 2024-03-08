<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class MarginOfErrorModel
{
    public const DESCRIPTION = 'A [[marginOfError]] for an [[Observation]].';
    public const LABEL = 'marginOfError';
    public const NAME = 'schema:marginOfError';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Observation' => 'SchemaOrg\Type\ObservationModel'];
}
