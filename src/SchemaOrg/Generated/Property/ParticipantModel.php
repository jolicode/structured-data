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

final class ParticipantModel
{
    public const DESCRIPTION = 'Other co-agents that participated in the action indirectly. E.g. John wrote a book with *Steve*.';
    public const LABEL = 'participant';
    public const NAME = 'schema:participant';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Action' => 'Jolicode\SchemaOrg\Type\ActionModel'];
}
