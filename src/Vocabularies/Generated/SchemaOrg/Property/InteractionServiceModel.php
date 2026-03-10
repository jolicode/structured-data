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

final class InteractionServiceModel
{
    public const DESCRIPTION = 'The WebSite or SoftwareApplication where the interactions took place.';
    public const LABEL = 'interactionService';
    public const NAME = 'schema:interactionService';
    public const VALUES = ['SoftwareApplicationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\SoftwareApplicationModel', 'WebSiteModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\WebSiteModel'];
    public const TYPES = ['InteractionCounter' => 'Jolicode\Vocabularies\SchemaOrg\Type\InteractionCounterModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
