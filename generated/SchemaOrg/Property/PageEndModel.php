<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class PageEndModel
{
    public const DESCRIPTION = 'The page on which the work ends; for example "138" or "xvi".';
    public const LABEL = 'pageEnd';
    public const NAME = 'schema:pageEnd';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\\Type\\IntegerModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Article' => 'SchemaOrg\\Type\\ArticleModel', 'Chapter' => 'SchemaOrg\\Type\\ChapterModel', 'PublicationIssue' => 'SchemaOrg\\Type\\PublicationIssueModel', 'PublicationVolume' => 'SchemaOrg\\Type\\PublicationVolumeModel'];
}
