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

final class PaginationModel
{
    public const DESCRIPTION = 'Any description of pages that is not separated into pageStart and pageEnd; for example, "1-6, 9, 55" or "10-12, 46-49".';
    public const LABEL = 'pagination';
    public const NAME = 'schema:pagination';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Article' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ArticleModel', 'Chapter' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ChapterModel', 'PublicationIssue' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PublicationIssueModel', 'PublicationVolume' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PublicationVolumeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
