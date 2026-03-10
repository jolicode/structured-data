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

final class AcrissCodeModel
{
    public const DESCRIPTION = 'The ACRISS Car Classification Code is a code used by many car rental companies, for classifying vehicles. ACRISS stands for Association of Car Rental Industry Systems and Standards.';
    public const LABEL = 'acrissCode';
    public const NAME = 'schema:acrissCode';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BusOrCoach' => 'Jolicode\Vocabularies\SchemaOrg\Type\BusOrCoachModel', 'Car' => 'Jolicode\Vocabularies\SchemaOrg\Type\CarModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
