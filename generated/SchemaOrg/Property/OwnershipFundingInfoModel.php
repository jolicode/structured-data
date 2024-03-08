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

final class OwnershipFundingInfoModel
{
    public const DESCRIPTION = 'For an [[Organization]] (often but not necessarily a [[NewsMediaOrganization]]), a description of organizational ownership structure; funding and grants. In a news/media setting, this is with particular reference to editorial independence.   Note that the [[funder]] is also available and can be used to make basic funder information machine-readable.';
    public const LABEL = 'ownershipFundingInfo';
    public const NAME = 'schema:ownershipFundingInfo';
    public const VALUES = ['AboutPageModel' => 'SchemaOrg\\Type\\AboutPageModel', 'CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'SchemaOrg\\Type\\NewsMediaOrganizationModel', 'Organization' => 'SchemaOrg\\Type\\OrganizationModel'];
}
