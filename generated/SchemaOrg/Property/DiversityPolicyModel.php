<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class DiversityPolicyModel
{
    public const DESCRIPTION = 'Statement on diversity policy by an [[Organization]] e.g. a [[NewsMediaOrganization]]. For a [[NewsMediaOrganization]], a statement describing the newsroom’s diversity policy on both staffing and sources, typically providing staffing data.';
    public const LABEL = 'diversityPolicy';
    public const NAME = 'schema:diversityPolicy';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\Type\CreativeWorkModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'SchemaOrg\Type\NewsMediaOrganizationModel', 'Organization' => 'SchemaOrg\Type\OrganizationModel'];
}
