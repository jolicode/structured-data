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

final class VerificationFactCheckingPolicyModel
{
    public const DESCRIPTION = 'Disclosure about verification and fact-checking processes for a [[NewsMediaOrganization]] or other fact-checking [[Organization]].';
    public const LABEL = 'verificationFactCheckingPolicy';
    public const NAME = 'schema:verificationFactCheckingPolicy';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\Type\CreativeWorkModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'SchemaOrg\Type\NewsMediaOrganizationModel'];
}
