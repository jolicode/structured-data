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

final class LastReviewedModel
{
    public const DESCRIPTION = 'Date on which the content on this web page was last reviewed for accuracy and/or completeness.';
    public const LABEL = 'lastReviewed';
    public const NAME = 'schema:lastReviewed';
    public const VALUES = ['DateModel' => 'SchemaOrg\\Type\\DateModel'];
    public const TYPES = ['WebPage' => 'SchemaOrg\\Type\\WebPageModel'];
}
