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

final class MainContentOfPageModel
{
    public const DESCRIPTION = 'Indicates if this web page element is the main subject of the page.';
    public const LABEL = 'mainContentOfPage';
    public const NAME = 'schema:mainContentOfPage';
    public const VALUES = ['WebPageElementModel' => 'Jolicode\SchemaOrg\Type\WebPageElementModel'];
    public const TYPES = ['WebPage' => 'Jolicode\SchemaOrg\Type\WebPageModel'];
}
