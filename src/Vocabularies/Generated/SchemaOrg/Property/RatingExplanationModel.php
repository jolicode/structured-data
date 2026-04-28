<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class RatingExplanationModel
{
    public const DESCRIPTION = 'A short explanation (e.g. one to two sentences) providing background context and other information that led to the conclusion expressed in the rating. This is particularly applicable to ratings associated with "fact check" markup using [[ClaimReview]].';
    public const LABEL = 'ratingExplanation';
    public const NAME = 'schema:ratingExplanation';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Rating' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\RatingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
