<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\EnumerationMember;

final class EventPostponedModel
{
    public const DESCRIPTION = 'The event has been postponed and no new date has been set. The event\'s previousStartDate should be set.';
    public const LABEL = 'EventPostponed';
    public const NAME = 'schema:EventPostponed';
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
