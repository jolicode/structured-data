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

final class MediaItemAppearanceModel
{
    public const DESCRIPTION = 'In the context of a [[MediaReview]], indicates specific media item(s) that are grouped using a [[MediaReviewItem]].';
    public const LABEL = 'mediaItemAppearance';
    public const NAME = 'schema:mediaItemAppearance';
    public const VALUES = ['MediaObjectModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaObjectModel'];
    public const TYPES = ['MediaReviewItem' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaReviewItemModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
