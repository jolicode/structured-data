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

final class InteractionTypeModel
{
    public const DESCRIPTION = 'The Action representing the type of interaction. For up votes, +1s, etc. use [[LikeAction]]. For down votes use [[DislikeAction]]. Otherwise, use the most specific Action.';
    public const LABEL = 'interactionType';
    public const NAME = 'schema:interactionType';
    public const VALUES = ['ActionModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ActionModel'];
    public const TYPES = ['InteractionCounter' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\InteractionCounterModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
