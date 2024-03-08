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

final class ClaimReviewedModel
{
    public const DESCRIPTION = 'A short summary of the specific claims reviewed in a ClaimReview.';
    public const LABEL = 'claimReviewed';
    public const NAME = 'schema:claimReviewed';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['ClaimReview' => 'SchemaOrg\Type\ClaimReviewModel'];
}
