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

final class PencilerModel
{
    public const DESCRIPTION = 'The individual who draws the primary narrative artwork.';
    public const LABEL = 'penciler';
    public const NAME = 'schema:penciler';
    public const VALUES = ['PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['ComicIssue' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ComicIssueModel', 'ComicStory' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ComicStoryModel', 'VisualArtwork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\VisualArtworkModel'];
    public const IS_PART_OF = ['https://bib.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
