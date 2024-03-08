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

final class ReviewAspectModel
{
    public const DESCRIPTION = 'This Review or Rating is relevant to this part or facet of the itemReviewed.';
    public const LABEL = 'reviewAspect';
    public const NAME = 'schema:reviewAspect';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Guide' => 'SchemaOrg\\Type\\GuideModel', 'Rating' => 'SchemaOrg\\Type\\RatingModel', 'Review' => 'SchemaOrg\\Type\\ReviewModel'];
}
