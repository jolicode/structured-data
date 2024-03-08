<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class InteractionServiceModel
{
    public const DESCRIPTION = 'The WebSite or SoftwareApplication where the interactions took place.';
    public const LABEL = 'interactionService';
    public const NAME = 'schema:interactionService';
    public const VALUES = ['SoftwareApplicationModel' => 'SchemaOrg\\Type\\SoftwareApplicationModel', 'WebSiteModel' => 'SchemaOrg\\Type\\WebSiteModel'];
    public const TYPES = ['InteractionCounter' => 'SchemaOrg\\Type\\InteractionCounterModel'];
}
