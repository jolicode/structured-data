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

final class PrimaryImageOfPageModel
{
    public const DESCRIPTION = 'Indicates the main image on the page.';
    public const LABEL = 'primaryImageOfPage';
    public const NAME = 'schema:primaryImageOfPage';
    public const VALUES = ['ImageObjectModel' => 'Jolicode\SchemaOrg\Type\ImageObjectModel'];
    public const TYPES = ['WebPage' => 'Jolicode\SchemaOrg\Type\WebPageModel'];
}
