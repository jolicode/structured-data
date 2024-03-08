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

final class OpeningHoursSpecificationModel
{
    public const DESCRIPTION = 'The opening hours of a certain place.';
    public const LABEL = 'openingHoursSpecification';
    public const NAME = 'schema:openingHoursSpecification';
    public const VALUES = ['OpeningHoursSpecificationModel' => 'SchemaOrg\\Type\\OpeningHoursSpecificationModel'];
    public const TYPES = ['Place' => 'SchemaOrg\\Type\\PlaceModel'];
}
