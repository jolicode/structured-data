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

final class AssociatedMediaReviewModel
{
    public const DESCRIPTION = 'An associated [[MediaReview]], related by specific common content, topic or claim. The expectation is that this property would be most typically used in cases where a single activity is conducting both claim reviews and media reviews, in which case [[relatedMediaReview]] would commonly be used on a [[ClaimReview]], while [[relatedClaimReview]] would be used on [[MediaReview]].';
    public const LABEL = 'associatedMediaReview';
    public const NAME = 'schema:associatedMediaReview';
    public const VALUES = ['ReviewModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ReviewModel'];
    public const TYPES = ['Review' => 'Jolicode\Vocabularies\SchemaOrg\Type\ReviewModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
