<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class IssnModel
{
    public const DESCRIPTION = 'The International Standard Serial Number (ISSN) that identifies this serial publication. You can repeat this property to identify different formats of, or the linking ISSN (ISSN-L) for, this serial publication.';
    public const LABEL = 'issn';
    public const NAME = 'schema:issn';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Blog' => 'SchemaOrg\Type\BlogModel', 'CreativeWorkSeries' => 'SchemaOrg\Type\CreativeWorkSeriesModel', 'Dataset' => 'SchemaOrg\Type\DatasetModel', 'WebSite' => 'SchemaOrg\Type\WebSiteModel'];
}
