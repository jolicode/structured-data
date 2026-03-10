<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\EnumerationMember;

final class EditedOrCroppedContentModel
{
    public const DESCRIPTION = 'Content coded \'edited or cropped content\' in a [[MediaReview]], considered in the context of how it was published or shared.

For a [[VideoObject]] to be \'edited or cropped content\': The video has been edited or rearranged. This category applies to time edits, including editing multiple videos together to alter the story being told or editing out large portions from a video.

For an [[ImageObject]] to be \'edited or cropped content\': Presenting a part of an image from a larger whole to mislead the viewer.

For an [[ImageObject]] with embedded text to be \'edited or cropped content\': Presenting a part of an image from a larger whole to mislead the viewer.

For an [[AudioObject]] to be \'edited or cropped content\': The audio has been edited or rearranged. This category applies to time edits, including editing multiple audio clips together to alter the story being told or editing out large portions from the recording.';
    public const LABEL = 'EditedOrCroppedContent';
    public const NAME = 'schema:EditedOrCroppedContent';
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
