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

final class BreadcrumbModel
{
    public const DESCRIPTION = 'A set of links that can help a user understand and navigate a website hierarchy.';
    public const LABEL = 'breadcrumb';
    public const NAME = 'schema:breadcrumb';
    public const VALUES = ['BreadcrumbListModel' => 'Jolicode\SchemaOrg\Type\BreadcrumbListModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['WebPage' => 'Jolicode\SchemaOrg\Type\WebPageModel'];
}
