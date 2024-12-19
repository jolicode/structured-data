<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class OriginalMediaLinkModel
{
    public const DESCRIPTION = 'Link to the page containing an original version of the content, or directly to an online copy of the original [[MediaObject]] content, e.g. video file.';
    public const LABEL = 'originalMediaLink';
    public const NAME = 'schema:originalMediaLink';
    public const VALUES = ['MediaObjectModel' => 'Jolicode\SchemaOrg\Type\MediaObjectModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel', 'WebPageModel' => 'Jolicode\SchemaOrg\Type\WebPageModel'];
    public const TYPES = ['MediaReview' => 'Jolicode\SchemaOrg\Type\MediaReviewModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
