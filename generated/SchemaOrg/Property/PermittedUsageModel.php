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

final class PermittedUsageModel
{
    public const DESCRIPTION = 'Indications regarding the permitted usage of the accommodation.';
    public const LABEL = 'permittedUsage';
    public const NAME = 'schema:permittedUsage';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Accommodation' => 'SchemaOrg\Type\AccommodationModel'];
}
