<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class GlobalLocationNumberModel
{
    public const DESCRIPTION = 'The [Global Location Number](http://www.gs1.org/gln) (GLN, sometimes also referred to as International Location Number or ILN) of the respective organization, person, or place. The GLN is a 13-digit number used to identify parties and physical locations.';
    public const LABEL = 'globalLocationNumber';
    public const NAME = 'schema:globalLocationNumber';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel', 'Place' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
