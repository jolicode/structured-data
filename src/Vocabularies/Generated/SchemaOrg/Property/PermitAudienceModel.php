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

final class PermitAudienceModel
{
    public const DESCRIPTION = 'The target audience for this permit.';
    public const LABEL = 'permitAudience';
    public const NAME = 'schema:permitAudience';
    public const VALUES = ['AudienceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AudienceModel'];
    public const TYPES = ['Permit' => 'Jolicode\Vocabularies\SchemaOrg\Type\PermitModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
