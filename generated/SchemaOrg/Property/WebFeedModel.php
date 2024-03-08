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

final class WebFeedModel
{
    public const DESCRIPTION = 'The URL for a feed, e.g. associated with a podcast series, blog, or series of date-stamped updates. This is usually RSS or Atom.';
    public const LABEL = 'webFeed';
    public const NAME = 'schema:webFeed';
    public const VALUES = ['DataFeedModel' => 'SchemaOrg\\Type\\DataFeedModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['PodcastSeries' => 'SchemaOrg\\Type\\PodcastSeriesModel', 'SpecialAnnouncement' => 'SchemaOrg\\Type\\SpecialAnnouncementModel'];
}
