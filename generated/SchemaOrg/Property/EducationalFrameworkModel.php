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

final class EducationalFrameworkModel
{
    public const DESCRIPTION = 'The framework to which the resource being described is aligned.';
    public const LABEL = 'educationalFramework';
    public const NAME = 'schema:educationalFramework';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['AlignmentObject' => 'SchemaOrg\Type\AlignmentObjectModel'];
}
