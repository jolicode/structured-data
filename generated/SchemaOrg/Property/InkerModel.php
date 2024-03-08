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

final class InkerModel
{
    public const DESCRIPTION = 'The individual who traces over the pencil drawings in ink after pencils are complete.';
    public const LABEL = 'inker';
    public const NAME = 'schema:inker';
    public const VALUES = ['PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['ComicIssue' => 'SchemaOrg\Type\ComicIssueModel', 'ComicStory' => 'SchemaOrg\Type\ComicStoryModel', 'VisualArtwork' => 'SchemaOrg\Type\VisualArtworkModel'];
}
