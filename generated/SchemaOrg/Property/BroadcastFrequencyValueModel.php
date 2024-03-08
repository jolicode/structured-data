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

final class BroadcastFrequencyValueModel
{
    public const DESCRIPTION = 'The frequency in MHz for a particular broadcast.';
    public const LABEL = 'broadcastFrequencyValue';
    public const NAME = 'schema:broadcastFrequencyValue';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel', 'QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel'];
    public const TYPES = ['BroadcastFrequencySpecification' => 'SchemaOrg\\Type\\BroadcastFrequencySpecificationModel'];
}
