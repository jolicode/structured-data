<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\EnumerationMember;

final class GraphicNovelModel
{
    public const DESCRIPTION = 'This type is deprecated: GraphicNovel does not fit the BookFormatType enumeration, as it can appear in multiple formats (e.g., Hardcover, eBook). It is not mutually exclusive and therefore deprecated. Use standard BookFormatType values instead in combination with the SequentialArt.

Book format: GraphicNovel. May represent a bound collection of ComicIssue instances.';
    public const LABEL = 'GraphicNovel';
    public const NAME = 'schema:GraphicNovel';
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
