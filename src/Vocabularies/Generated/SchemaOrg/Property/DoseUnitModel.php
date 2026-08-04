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

final class DoseUnitModel
{
    public const DESCRIPTION = 'The unit of the dose, e.g. \'mg\'.';
    public const LABEL = 'doseUnit';
    public const NAME = 'schema:doseUnit';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DoseSchedule' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DoseScheduleModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
