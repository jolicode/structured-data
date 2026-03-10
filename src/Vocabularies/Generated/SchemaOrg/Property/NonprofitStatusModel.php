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

final class NonprofitStatusModel
{
    public const DESCRIPTION = 'nonprofitStatus indicates the legal status of a non-profit organization in its primary place of business.';
    public const LABEL = 'nonprofitStatus';
    public const NAME = 'schema:nonprofitStatus';
    public const VALUES = ['NonprofitTypeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NonprofitTypeModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
