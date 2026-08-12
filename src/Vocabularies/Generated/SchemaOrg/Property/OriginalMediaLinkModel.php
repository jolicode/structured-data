<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class OriginalMediaLinkModel
{
    public const DESCRIPTION = 'Link to the page containing an original version of the content, or directly to an online copy of the original [[MediaObject]] content, e.g. video file.';
    public const LABEL = 'originalMediaLink';
    public const NAME = 'schema:originalMediaLink';
    public const VALUES = ['MediaObjectModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MediaObjectModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel', 'WebPageModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\WebPageModel'];
    public const TYPES = ['MediaReview' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MediaReviewModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2450'];
    public const SUPERSEDED_BY = null;
}
