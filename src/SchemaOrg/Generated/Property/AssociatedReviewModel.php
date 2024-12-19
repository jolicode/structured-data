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

final class AssociatedReviewModel
{
    public const DESCRIPTION = 'An associated [[Review]].';
    public const LABEL = 'associatedReview';
    public const NAME = 'schema:associatedReview';
    public const VALUES = ['ReviewModel' => 'Jolicode\SchemaOrg\Type\ReviewModel'];
    public const TYPES = ['Review' => 'Jolicode\SchemaOrg\Type\ReviewModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
