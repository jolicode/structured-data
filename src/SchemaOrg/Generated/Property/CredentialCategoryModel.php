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

final class CredentialCategoryModel
{
    public const DESCRIPTION = 'The category or type of credential being described, for example "degree”, “certificate”, “badge”, or more specific term.';
    public const LABEL = 'credentialCategory';
    public const NAME = 'schema:credentialCategory';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['EducationalOccupationalCredential' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalCredentialModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
