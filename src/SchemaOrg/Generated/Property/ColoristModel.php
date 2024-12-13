<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ColoristModel
{
    public const DESCRIPTION = 'The individual who adds color to inked drawings.';
    public const LABEL = 'colorist';
    public const NAME = 'schema:colorist';
    public const VALUES = ['PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['ComicIssue' => 'Jolicode\SchemaOrg\Type\ComicIssueModel', 'ComicStory' => 'Jolicode\SchemaOrg\Type\ComicStoryModel', 'VisualArtwork' => 'Jolicode\SchemaOrg\Type\VisualArtworkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
