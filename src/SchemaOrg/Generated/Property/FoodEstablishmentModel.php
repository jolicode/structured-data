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

final class FoodEstablishmentModel
{
    public const DESCRIPTION = 'A sub property of location. The specific food establishment where the action occurred.';
    public const LABEL = 'foodEstablishment';
    public const NAME = 'schema:foodEstablishment';
    public const VALUES = ['FoodEstablishmentModel' => 'Jolicode\SchemaOrg\Type\FoodEstablishmentModel', 'PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['CookAction' => 'Jolicode\SchemaOrg\Type\CookActionModel'];
}
