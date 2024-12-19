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

final class CitationModel
{
    public const DESCRIPTION = 'A citation or reference to another creative work, such as another publication, web page, scholarly article, etc.';
    public const LABEL = 'citation';
    public const NAME = 'schema:citation';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
