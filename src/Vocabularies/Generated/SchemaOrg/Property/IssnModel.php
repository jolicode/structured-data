<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class IssnModel
{
    public const DESCRIPTION = 'The International Standard Serial Number (ISSN) that identifies this serial publication. You can repeat this property to identify different formats of, or the linking ISSN (ISSN-L) for, this serial publication.';
    public const LABEL = 'issn';
    public const NAME = 'schema:issn';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Blog' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BlogModel', 'CreativeWorkSeries' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkSeriesModel', 'Dataset' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DatasetModel', 'WebSite' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\WebSiteModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
