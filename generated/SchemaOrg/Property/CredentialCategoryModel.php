<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class CredentialCategoryModel
{
    public const DESCRIPTION = 'The category or type of credential being described, for example "degree”, “certificate”, “badge”, or more specific term.';
    public const LABEL = 'credentialCategory';
    public const NAME = 'schema:credentialCategory';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\\Type\\DefinedTermModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['EducationalOccupationalCredential' => 'SchemaOrg\\Type\\EducationalOccupationalCredentialModel'];
}
