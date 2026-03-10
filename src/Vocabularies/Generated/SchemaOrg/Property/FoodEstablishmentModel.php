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

final class FoodEstablishmentModel
{
    public const DESCRIPTION = 'A sub property of location. The specific food establishment where the action occurred.';
    public const LABEL = 'foodEstablishment';
    public const NAME = 'schema:foodEstablishment';
    public const VALUES = ['FoodEstablishmentModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\FoodEstablishmentModel', 'PlaceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['CookAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\CookActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
