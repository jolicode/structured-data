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

final class PencilerModel
{
    public const DESCRIPTION = 'The individual who draws the primary narrative artwork.';
    public const LABEL = 'penciler';
    public const NAME = 'schema:penciler';
    public const VALUES = ['PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['ComicIssue' => 'SchemaOrg\\Type\\ComicIssueModel', 'ComicStory' => 'SchemaOrg\\Type\\ComicStoryModel', 'VisualArtwork' => 'SchemaOrg\\Type\\VisualArtworkModel'];
}
