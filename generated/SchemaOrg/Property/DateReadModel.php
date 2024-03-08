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

final class DateReadModel
{
    public const DESCRIPTION = 'The date/time at which the message has been read by the recipient if a single recipient exists.';
    public const LABEL = 'dateRead';
    public const NAME = 'schema:dateRead';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel', 'DateTimeModel' => 'SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Message' => 'SchemaOrg\Type\MessageModel'];
}
