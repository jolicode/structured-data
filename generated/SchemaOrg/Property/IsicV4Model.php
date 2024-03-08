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

final class IsicV4Model
{
    public const DESCRIPTION = 'The International Standard of Industrial Classification of All Economic Activities (ISIC), Revision 4 code for a particular organization, business person, or place.';
    public const LABEL = 'isicV4';
    public const NAME = 'schema:isicV4';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\Type\OrganizationModel', 'Person' => 'SchemaOrg\Type\PersonModel', 'Place' => 'SchemaOrg\Type\PlaceModel'];
}
