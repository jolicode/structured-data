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

final class TransformedContentModel
{
    public const DESCRIPTION = 'Content coded \'transformed content\' in a [[MediaReview]], considered in the context of how it was published or shared.

For a [[VideoObject]] to be \'transformed content\':  or all of the video has been manipulated to transform the footage itself. This category includes using tools like the Adobe Suite to change the speed of the video, add or remove visual elements or dub audio. Deepfakes are also a subset of transformation.

For an [[ImageObject]] to be \'transformed content\': Adding or deleting visual elements to give the image a different meaning with the intention to mislead.

For an [[ImageObject]] with embedded text to be \'transformed content\': Adding or deleting visual elements to give the image a different meaning with the intention to mislead.

For an [[AudioObject]] to be \'transformed content\': Part or all of the audio has been manipulated to alter the words or sounds, or the audio has been synthetically generated, such as to create a sound-alike voice.';
    public const LABEL = 'TransformedContent';
    public const NAME = 'schema:TransformedContent';
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
