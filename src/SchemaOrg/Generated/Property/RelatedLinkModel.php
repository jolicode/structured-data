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

final class RelatedLinkModel
{
    public const DESCRIPTION = 'A link related to this web page, for example to other related web pages.';
    public const LABEL = 'relatedLink';
    public const NAME = 'schema:relatedLink';
    public const VALUES = ['URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['WebPage' => 'Jolicode\SchemaOrg\Type\WebPageModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
