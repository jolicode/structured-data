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

final class StagedContentModel
{
    public const DESCRIPTION = 'Content coded \'staged content\' in a [[MediaReview]], considered in the context of how it was published or shared.

For a [[VideoObject]] to be \'staged content\': A video that has been created using actors or similarly contrived.

For an [[ImageObject]] to be \'staged content\': An image that was created using actors or similarly contrived, such as a screenshot of a fake tweet.

For an [[ImageObject]] with embedded text to be \'staged content\': An image that was created using actors or similarly contrived, such as a screenshot of a fake tweet.

For an [[AudioObject]] to be \'staged content\': Audio that has been created using actors or similarly contrived.';
    public const LABEL = 'StagedContent';
    public const NAME = 'schema:StagedContent';
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
