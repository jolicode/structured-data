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

final class ReviewAspectModel
{
    public const DESCRIPTION = 'This Review or Rating is relevant to this part or facet of the itemReviewed.';
    public const LABEL = 'reviewAspect';
    public const NAME = 'schema:reviewAspect';
    public const VALUES = ['StructuredValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\StructuredValueModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Guide' => 'Jolicode\Vocabularies\SchemaOrg\Type\GuideModel', 'Rating' => 'Jolicode\Vocabularies\SchemaOrg\Type\RatingModel', 'Review' => 'Jolicode\Vocabularies\SchemaOrg\Type\ReviewModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
