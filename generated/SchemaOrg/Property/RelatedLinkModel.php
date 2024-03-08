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

final class RelatedLinkModel
{
    public const DESCRIPTION = 'A link related to this web page, for example to other related web pages.';
    public const LABEL = 'relatedLink';
    public const NAME = 'schema:relatedLink';
    public const VALUES = ['URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['WebPage' => 'SchemaOrg\\Type\\WebPageModel'];
}
