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

final class LegislationConsolidatesModel
{
    public const DESCRIPTION = 'Indicates another legislation taken into account in this consolidated legislation (which is usually the product of an editorial process that revises the legislation). This property should be used multiple times to refer to both the original version or the previous consolidated version, and to the legislations making the change.';
    public const LABEL = 'legislationConsolidates';
    public const NAME = 'schema:legislationConsolidates';
    public const VALUES = ['LegislationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\LegislationModel'];
    public const TYPES = ['Legislation' => 'Jolicode\Vocabularies\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
