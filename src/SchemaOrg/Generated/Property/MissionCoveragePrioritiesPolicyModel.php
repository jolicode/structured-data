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

final class MissionCoveragePrioritiesPolicyModel
{
    public const DESCRIPTION = 'For a [[NewsMediaOrganization]], a statement on coverage priorities, including any public agenda or stance on issues.';
    public const LABEL = 'missionCoveragePrioritiesPolicy';
    public const NAME = 'schema:missionCoveragePrioritiesPolicy';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'Jolicode\SchemaOrg\Type\NewsMediaOrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
