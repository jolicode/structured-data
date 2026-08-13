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

final class WebFeedModel
{
    public const DESCRIPTION = 'The URL for a feed, e.g. associated with a podcast series, blog, or series of date-stamped updates. This is usually RSS or Atom.';
    public const LABEL = 'webFeed';
    public const NAME = 'schema:webFeed';
    public const VALUES = ['DataFeedModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DataFeedModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['PodcastSeries' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PodcastSeriesModel', 'SpecialAnnouncement' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SpecialAnnouncementModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/373'];
    public const SUPERSEDED_BY = null;
}
