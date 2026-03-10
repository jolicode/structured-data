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

final class AcceptsReservationsModel
{
    public const DESCRIPTION = 'Indicates whether a FoodEstablishment accepts reservations. Values can be Boolean, an URL at which reservations can be made or (for backwards compatibility) the strings ```Yes``` or ```No```.';
    public const LABEL = 'acceptsReservations';
    public const NAME = 'schema:acceptsReservations';
    public const VALUES = ['BooleanModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BooleanModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['FoodEstablishment' => 'Jolicode\Vocabularies\SchemaOrg\Type\FoodEstablishmentModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
