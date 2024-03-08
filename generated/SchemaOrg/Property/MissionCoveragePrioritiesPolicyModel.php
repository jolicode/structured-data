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

final class MissionCoveragePrioritiesPolicyModel
{
    public const DESCRIPTION = 'For a [[NewsMediaOrganization]], a statement on coverage priorities, including any public agenda or stance on issues.';
    public const LABEL = 'missionCoveragePrioritiesPolicy';
    public const NAME = 'schema:missionCoveragePrioritiesPolicy';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'SchemaOrg\\Type\\NewsMediaOrganizationModel'];
}
