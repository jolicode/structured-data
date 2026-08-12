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

final class CertificationRatingModel
{
    public const DESCRIPTION = 'Rating of a certification instance (as defined by an independent certification body). Typically this rating can be used to rate the level to which the requirements of the certification instance are fulfilled. See also [gs1:certificationValue](https://www.gs1.org/voc/certificationValue).';
    public const LABEL = 'certificationRating';
    public const NAME = 'schema:certificationRating';
    public const VALUES = ['RatingModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RatingModel'];
    public const TYPES = ['Certification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CertificationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3230'];
    public const SUPERSEDED_BY = null;
}
