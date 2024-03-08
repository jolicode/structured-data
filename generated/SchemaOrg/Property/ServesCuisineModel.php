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

final class ServesCuisineModel
{
    public const DESCRIPTION = 'The cuisine of the restaurant.';
    public const LABEL = 'servesCuisine';
    public const NAME = 'schema:servesCuisine';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['FoodEstablishment' => 'SchemaOrg\\Type\\FoodEstablishmentModel'];
}
