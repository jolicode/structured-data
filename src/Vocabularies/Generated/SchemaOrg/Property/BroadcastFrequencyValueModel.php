<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class BroadcastFrequencyValueModel
{
    public const DESCRIPTION = 'The frequency in MHz for a particular broadcast.';
    public const LABEL = 'broadcastFrequencyValue';
    public const NAME = 'schema:broadcastFrequencyValue';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['BroadcastFrequencySpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\BroadcastFrequencySpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
