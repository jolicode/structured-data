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

final class TypeOfBedModel
{
    public const DESCRIPTION = 'The type of bed to which the BedDetail refers, i.e. the type of bed available in the quantity indicated by quantity.';
    public const LABEL = 'typeOfBed';
    public const NAME = 'schema:typeOfBed';
    public const VALUES = ['BedTypeModel' => 'SchemaOrg\Type\BedTypeModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['BedDetails' => 'SchemaOrg\Type\BedDetailsModel'];
}
