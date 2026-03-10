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

final class ReviewBodyModel
{
    public const DESCRIPTION = 'The actual body of the review.';
    public const LABEL = 'reviewBody';
    public const NAME = 'schema:reviewBody';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Review' => 'Jolicode\Vocabularies\SchemaOrg\Type\ReviewModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
