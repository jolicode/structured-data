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

final class PageStartModel
{
    public const DESCRIPTION = 'The page on which the work starts; for example "135" or "xiii".';
    public const LABEL = 'pageStart';
    public const NAME = 'schema:pageStart';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\Type\IntegerModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Article' => 'SchemaOrg\Type\ArticleModel', 'Chapter' => 'SchemaOrg\Type\ChapterModel', 'PublicationIssue' => 'SchemaOrg\Type\PublicationIssueModel', 'PublicationVolume' => 'SchemaOrg\Type\PublicationVolumeModel'];
}
