<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class DateReceivedModel
{
    public const DESCRIPTION = 'The date/time the message was received if a single recipient exists.';
    public const LABEL = 'dateReceived';
    public const NAME = 'schema:dateReceived';
    public const VALUES = ['DateTimeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Message' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MessageModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
