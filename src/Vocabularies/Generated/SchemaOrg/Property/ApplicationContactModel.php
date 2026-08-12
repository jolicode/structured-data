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

final class ApplicationContactModel
{
    public const DESCRIPTION = 'Contact details for further information relevant to this job posting.';
    public const LABEL = 'applicationContact';
    public const NAME = 'schema:applicationContact';
    public const VALUES = ['ContactPointModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ContactPointModel'];
    public const TYPES = ['JobPosting' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\JobPostingModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2396'];
    public const SUPERSEDED_BY = null;
}
