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

final class ColoristModel
{
    public const DESCRIPTION = 'The individual who adds color to inked drawings.';
    public const LABEL = 'colorist';
    public const NAME = 'schema:colorist';
    public const VALUES = ['PersonModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['ComicIssue' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ComicIssueModel', 'ComicStory' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ComicStoryModel', 'VisualArtwork' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VisualArtworkModel'];
    public const IS_PART_OF = ['https://bib.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
