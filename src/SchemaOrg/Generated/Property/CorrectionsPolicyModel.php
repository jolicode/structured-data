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

final class CorrectionsPolicyModel
{
    public const DESCRIPTION = 'For an [[Organization]] (e.g. [[NewsMediaOrganization]]), a statement describing (in news media, the newsroom’s) disclosure and correction policy for errors.';
    public const LABEL = 'correctionsPolicy';
    public const NAME = 'schema:correctionsPolicy';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'Jolicode\SchemaOrg\Type\NewsMediaOrganizationModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
}
