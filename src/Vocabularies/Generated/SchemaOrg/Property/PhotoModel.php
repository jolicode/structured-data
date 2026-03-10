<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class PhotoModel
{
    public const DESCRIPTION = 'A photograph of this place.';
    public const LABEL = 'photo';
    public const NAME = 'schema:photo';
    public const VALUES = ['ImageObjectModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ImageObjectModel', 'PhotographModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PhotographModel'];
    public const TYPES = ['Place' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
