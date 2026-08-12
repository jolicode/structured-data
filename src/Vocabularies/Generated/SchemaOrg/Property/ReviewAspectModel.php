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

final class ReviewAspectModel
{
    public const DESCRIPTION = 'This Review or Rating is relevant to this part or facet of the itemReviewed.';
    public const LABEL = 'reviewAspect';
    public const NAME = 'schema:reviewAspect';
    public const VALUES = ['StructuredValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\StructuredValueModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Guide' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GuideModel', 'Rating' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RatingModel', 'Review' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ReviewModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1689'];
    public const SUPERSEDED_BY = null;
}
