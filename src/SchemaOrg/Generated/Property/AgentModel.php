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

final class AgentModel
{
    public const DESCRIPTION = 'The direct performer or driver of the action (animate or inanimate). E.g. *John* wrote a book.';
    public const LABEL = 'agent';
    public const NAME = 'schema:agent';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Action' => 'Jolicode\SchemaOrg\Type\ActionModel'];
}
