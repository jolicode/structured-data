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

final class GlobalLocationNumberModel
{
    public const DESCRIPTION = 'The [Global Location Number](http://www.gs1.org/gln) (GLN, sometimes also referred to as International Location Number or ILN) of the respective organization, person, or place. The GLN is a 13-digit number used to identify parties and physical locations.';
    public const LABEL = 'globalLocationNumber';
    public const NAME = 'schema:globalLocationNumber';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\\Type\\OrganizationModel', 'Person' => 'SchemaOrg\\Type\\PersonModel', 'Place' => 'SchemaOrg\\Type\\PlaceModel'];
}
