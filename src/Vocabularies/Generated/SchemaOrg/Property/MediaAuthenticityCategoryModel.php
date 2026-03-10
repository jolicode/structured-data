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

final class MediaAuthenticityCategoryModel
{
    public const DESCRIPTION = 'Indicates a MediaManipulationRatingEnumeration classification of a media object (in the context of how it was published or shared).';
    public const LABEL = 'mediaAuthenticityCategory';
    public const NAME = 'schema:mediaAuthenticityCategory';
    public const VALUES = ['MediaManipulationRatingEnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaManipulationRatingEnumerationModel'];
    public const TYPES = ['MediaReview' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaReviewModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
