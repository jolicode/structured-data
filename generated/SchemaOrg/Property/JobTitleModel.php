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

final class JobTitleModel
{
    public const DESCRIPTION = 'The job title of the person (for example, Financial Manager).';
    public const LABEL = 'jobTitle';
    public const NAME = 'schema:jobTitle';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Person' => 'SchemaOrg\Type\PersonModel'];
}
