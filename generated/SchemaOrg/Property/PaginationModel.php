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

final class PaginationModel
{
    public const DESCRIPTION = 'Any description of pages that is not separated into pageStart and pageEnd; for example, "1-6, 9, 55" or "10-12, 46-49".';
    public const LABEL = 'pagination';
    public const NAME = 'schema:pagination';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Article' => 'SchemaOrg\Type\ArticleModel', 'Chapter' => 'SchemaOrg\Type\ChapterModel', 'PublicationIssue' => 'SchemaOrg\Type\PublicationIssueModel', 'PublicationVolume' => 'SchemaOrg\Type\PublicationVolumeModel'];
}
