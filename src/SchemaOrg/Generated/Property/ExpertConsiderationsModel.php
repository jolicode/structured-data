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

final class ExpertConsiderationsModel
{
    public const DESCRIPTION = 'Medical expert advice related to the plan.';
    public const LABEL = 'expertConsiderations';
    public const NAME = 'schema:expertConsiderations';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Diet' => 'Jolicode\SchemaOrg\Type\DietModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
