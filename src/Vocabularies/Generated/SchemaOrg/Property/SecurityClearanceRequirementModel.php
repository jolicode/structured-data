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

final class SecurityClearanceRequirementModel
{
    public const DESCRIPTION = 'A description of any security clearance requirements of the job.';
    public const LABEL = 'securityClearanceRequirement';
    public const NAME = 'schema:securityClearanceRequirement';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['JobPosting' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\JobPostingModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2384'];
    public const SUPERSEDED_BY = null;
}
