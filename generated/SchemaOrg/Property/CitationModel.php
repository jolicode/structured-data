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

final class CitationModel
{
    public const DESCRIPTION = 'A citation or reference to another creative work, such as another publication, web page, scholarly article, etc.';
    public const LABEL = 'citation';
    public const NAME = 'schema:citation';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\Type\CreativeWorkModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel'];
}
