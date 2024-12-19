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

final class AccommodationCategoryModel
{
    public const DESCRIPTION = 'Category of an [[Accommodation]], following real estate conventions, e.g. RESO (see [PropertySubType](https://ddwiki.reso.org/display/DDW17/PropertySubType+Field), and [PropertyType](https://ddwiki.reso.org/display/DDW17/PropertyType+Field) fields  for suggested values).';
    public const LABEL = 'accommodationCategory';
    public const NAME = 'schema:accommodationCategory';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\SchemaOrg\Type\AccommodationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
