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

final class DecontextualizedContentModel
{
    public const DESCRIPTION = 'Content coded \'missing context\' in a [[MediaReview]], considered in the context of how it was published or shared.

For a [[VideoObject]] to be \'missing context\': Presenting unaltered video in an inaccurate manner that misrepresents the footage. For example, using incorrect dates or locations, altering the transcript or sharing brief clips from a longer video to mislead viewers. (A video rated \'original\' can also be missing context.)

For an [[ImageObject]] to be \'missing context\': Presenting unaltered images in an inaccurate manner to misrepresent the image and mislead the viewer. For example, a common tactic is using an unaltered image but saying it came from a different time or place. (An image rated \'original\' can also be missing context.)

For an [[ImageObject]] with embedded text to be \'missing context\': An unaltered image presented in an inaccurate manner to misrepresent the image and mislead the viewer. For example, a common tactic is using an unaltered image but saying it came from a different time or place. (An \'original\' image with inaccurate text would generally fall in this category.)

For an [[AudioObject]] to be \'missing context\': Unaltered audio presented in an inaccurate manner that misrepresents it. For example, using incorrect dates or locations, or sharing brief clips from a longer recording to mislead viewers. (Audio rated “original” can also be missing context.)';
    public const LABEL = 'DecontextualizedContent';
    public const NAME = 'schema:DecontextualizedContent';
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
