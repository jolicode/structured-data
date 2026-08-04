<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class AuthenticatorModel
{
    public const DESCRIPTION = 'The Organization responsible for authenticating the user\'s subscription. For example, many media apps require a cable/satellite provider to authenticate your subscription before playing media.';
    public const LABEL = 'authenticator';
    public const NAME = 'schema:authenticator';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['MediaSubscription' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MediaSubscriptionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1741'];
    public const SUPERSEDED_BY = null;
}
