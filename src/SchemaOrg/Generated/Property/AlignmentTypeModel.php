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

final class AlignmentTypeModel
{
    public const DESCRIPTION = 'A category of alignment between the learning resource and the framework node. Recommended values include: \'requires\', \'textComplexity\', \'readingLevel\', and \'educationalSubject\'.';
    public const LABEL = 'alignmentType';
    public const NAME = 'schema:alignmentType';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['AlignmentObject' => 'Jolicode\SchemaOrg\Type\AlignmentObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
