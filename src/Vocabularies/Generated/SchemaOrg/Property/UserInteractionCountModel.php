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

final class UserInteractionCountModel
{
    public const DESCRIPTION = 'The number of interactions for the CreativeWork using the WebSite or SoftwareApplication.';
    public const LABEL = 'userInteractionCount';
    public const NAME = 'schema:userInteractionCount';
    public const VALUES = ['IntegerModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['InteractionCounter' => 'Jolicode\Vocabularies\SchemaOrg\Type\InteractionCounterModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
