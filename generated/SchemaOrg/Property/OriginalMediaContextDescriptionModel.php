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

final class OriginalMediaContextDescriptionModel
{
    public const DESCRIPTION = 'Describes, in a [[MediaReview]] when dealing with [[DecontextualizedContent]], background information that can contribute to better interpretation of the [[MediaObject]].';
    public const LABEL = 'originalMediaContextDescription';
    public const NAME = 'schema:originalMediaContextDescription';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['MediaReview' => 'SchemaOrg\Type\MediaReviewModel'];
}
