<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class ResponsibilitiesModel
{
    public const DESCRIPTION = 'Responsibilities associated with this role or Occupation.';
    public const LABEL = 'responsibilities';
    public const NAME = 'schema:responsibilities';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\JobPostingModel', 'Occupation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OccupationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1698'];
    public const SUPERSEDED_BY = null;
}
