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

final class AgentInteractionStatisticModel
{
    public const DESCRIPTION = 'The number of completed interactions for this entity, in a particular role (the \'agent\'), in a particular action (indicated in the statistic), and in a particular context (i.e. interactionService).';
    public const LABEL = 'agentInteractionStatistic';
    public const NAME = 'schema:agentInteractionStatistic';
    public const VALUES = ['InteractionCounterModel' => 'Jolicode\SchemaOrg\Type\InteractionCounterModel'];
    public const TYPES = ['Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\SchemaOrg\Type\PersonModel'];
}
