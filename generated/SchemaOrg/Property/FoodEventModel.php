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

final class FoodEventModel
{
    public const DESCRIPTION = 'A sub property of location. The specific food event where the action occurred.';
    public const LABEL = 'foodEvent';
    public const NAME = 'schema:foodEvent';
    public const VALUES = ['FoodEventModel' => 'SchemaOrg\\Type\\FoodEventModel'];
    public const TYPES = ['CookAction' => 'SchemaOrg\\Type\\CookActionModel'];
}
