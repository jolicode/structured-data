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

final class AuthenticatorModel
{
    public const DESCRIPTION = 'The Organization responsible for authenticating the user\'s subscription. For example, many media apps require a cable/satellite provider to authenticate your subscription before playing media.';
    public const LABEL = 'authenticator';
    public const NAME = 'schema:authenticator';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['MediaSubscription' => 'Jolicode\SchemaOrg\Type\MediaSubscriptionModel'];
}
