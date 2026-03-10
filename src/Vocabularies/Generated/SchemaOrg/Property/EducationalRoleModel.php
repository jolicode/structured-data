<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class EducationalRoleModel
{
    public const DESCRIPTION = 'An educationalRole of an EducationalAudience.';
    public const LABEL = 'educationalRole';
    public const NAME = 'schema:educationalRole';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['EducationalAudience' => 'Jolicode\Vocabularies\SchemaOrg\Type\EducationalAudienceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
