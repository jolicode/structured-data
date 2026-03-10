<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class PageStartModel
{
    public const DESCRIPTION = 'The page on which the work starts; for example "135" or "xiii".';
    public const LABEL = 'pageStart';
    public const NAME = 'schema:pageStart';
    public const VALUES = ['IntegerModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\IntegerModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Article' => 'Jolicode\Vocabularies\SchemaOrg\Type\ArticleModel', 'Chapter' => 'Jolicode\Vocabularies\SchemaOrg\Type\ChapterModel', 'PublicationIssue' => 'Jolicode\Vocabularies\SchemaOrg\Type\PublicationIssueModel', 'PublicationVolume' => 'Jolicode\Vocabularies\SchemaOrg\Type\PublicationVolumeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
