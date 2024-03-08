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

final class SpecialOpeningHoursSpecificationModel
{
    public const DESCRIPTION = 'The special opening hours of a certain place.\n\nUse this to explicitly override general opening hours brought in scope by [[openingHoursSpecification]] or [[openingHours]].
      ';
    public const LABEL = 'specialOpeningHoursSpecification';
    public const NAME = 'schema:specialOpeningHoursSpecification';
    public const VALUES = ['OpeningHoursSpecificationModel' => 'SchemaOrg\Type\OpeningHoursSpecificationModel'];
    public const TYPES = ['Place' => 'SchemaOrg\Type\PlaceModel'];
}
