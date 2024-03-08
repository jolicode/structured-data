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

final class LettererModel
{
    public const DESCRIPTION = 'The individual who adds lettering, including speech balloons and sound effects, to artwork.';
    public const LABEL = 'letterer';
    public const NAME = 'schema:letterer';
    public const VALUES = ['PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['ComicIssue' => 'SchemaOrg\Type\ComicIssueModel', 'ComicStory' => 'SchemaOrg\Type\ComicStoryModel', 'VisualArtwork' => 'SchemaOrg\Type\VisualArtworkModel'];
}
