<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class PageStartModel
{
    public const DESCRIPTION = 'The page on which the work starts; for example "135" or "xiii".';
    public const LABEL = 'pageStart';
    public const NAME = 'schema:pageStart';
    public const VALUES = ['IntegerModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\IntegerModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Article' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ArticleModel', 'Chapter' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ChapterModel', 'PublicationIssue' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PublicationIssueModel', 'PublicationVolume' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PublicationVolumeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
