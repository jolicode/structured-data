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

final class ReviewAspectModel
{
    public const DESCRIPTION = 'This Review or Rating is relevant to this part or facet of the itemReviewed.';
    public const LABEL = 'reviewAspect';
    public const NAME = 'schema:reviewAspect';
    public const VALUES = ['StructuredValueModel' => 'Jolicode\SchemaOrg\Type\StructuredValueModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Guide' => 'Jolicode\SchemaOrg\Type\GuideModel', 'Rating' => 'Jolicode\SchemaOrg\Type\RatingModel', 'Review' => 'Jolicode\SchemaOrg\Type\ReviewModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
