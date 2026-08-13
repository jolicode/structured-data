<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class PhotosModel
{
    public const DESCRIPTION = 'Photographs of this place.';
    public const LABEL = 'photos';
    public const NAME = 'schema:photos';
    public const VALUES = ['ImageObjectModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ImageObjectModel', 'PhotographModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PhotographModel'];
    public const TYPES = ['Place' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'photo';
}
