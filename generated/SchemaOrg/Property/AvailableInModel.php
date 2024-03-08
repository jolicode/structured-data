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

final class AvailableInModel
{
    public const DESCRIPTION = 'The location in which the strength is available.';
    public const LABEL = 'availableIn';
    public const NAME = 'schema:availableIn';
    public const VALUES = ['AdministrativeAreaModel' => 'SchemaOrg\\Type\\AdministrativeAreaModel'];
    public const TYPES = ['DrugStrength' => 'SchemaOrg\\Type\\DrugStrengthModel'];
}
