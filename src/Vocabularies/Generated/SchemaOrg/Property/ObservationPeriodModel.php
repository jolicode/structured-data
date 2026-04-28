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

final class ObservationPeriodModel
{
    public const DESCRIPTION = 'The length of time an Observation took place over. The format follows `P[0-9]*[Y|M|D|h|m|s]`. For example, P1Y is Period 1 Year, P3M is Period 3 Months, P3h is Period 3 hours.';
    public const LABEL = 'observationPeriod';
    public const NAME = 'schema:observationPeriod';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Observation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ObservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
