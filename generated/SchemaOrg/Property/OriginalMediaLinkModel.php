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

final class OriginalMediaLinkModel
{
    public const DESCRIPTION = 'Link to the page containing an original version of the content, or directly to an online copy of the original [[MediaObject]] content, e.g. video file.';
    public const LABEL = 'originalMediaLink';
    public const NAME = 'schema:originalMediaLink';
    public const VALUES = ['MediaObjectModel' => 'SchemaOrg\\Type\\MediaObjectModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel', 'WebPageModel' => 'SchemaOrg\\Type\\WebPageModel'];
    public const TYPES = ['MediaReview' => 'SchemaOrg\\Type\\MediaReviewModel'];
}
