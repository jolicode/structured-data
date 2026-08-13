<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\EnumerationMember;

final class OriginalMediaContentModel
{
    public const DESCRIPTION = 'Content coded \'as original media content\' in a [[MediaReview]], considered in the context of how it was published or shared.

For a [[VideoObject]] to be \'original\': No evidence the footage has been misleadingly altered or manipulated, though it may contain false or misleading claims.

For an [[ImageObject]] to be \'original\': No evidence the image has been misleadingly altered or manipulated, though it may still contain false or misleading claims.

For an [[ImageObject]] with embedded text to be \'original\': No evidence the image has been misleadingly altered or manipulated, though it may still contain false or misleading claims.

For an [[AudioObject]] to be \'original\': No evidence the audio has been misleadingly altered or manipulated, though it may contain false or misleading claims.';
    public const LABEL = 'OriginalMediaContent';
    public const NAME = 'schema:OriginalMediaContent';
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2450'];
    public const SUPERSEDED_BY = null;
}
