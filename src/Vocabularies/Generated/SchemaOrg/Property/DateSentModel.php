<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class DateSentModel
{
    public const DESCRIPTION = 'The date/time at which the message was sent.';
    public const LABEL = 'dateSent';
    public const NAME = 'schema:dateSent';
    public const VALUES = ['DateTimeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Message' => 'Jolicode\Vocabularies\SchemaOrg\Type\MessageModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
