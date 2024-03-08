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

final class SignificantLinkModel
{
    public const DESCRIPTION = 'One of the more significant URLs on the page. Typically, these are the non-navigation links that are clicked on the most.';
    public const LABEL = 'significantLink';
    public const NAME = 'schema:significantLink';
    public const VALUES = ['URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['WebPage' => 'SchemaOrg\\Type\\WebPageModel'];
}
