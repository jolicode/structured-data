<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Type;

final class DateTimeModel
{
    public const DESCRIPTION = 'A combination of date and time of day in the form [-]CCYY-MM-DDThh:mm:ss[Z|(+|-)hh:mm] (see Chapter 5.4 of ISO 8601).';
    public const LABEL = 'DateTime';
    public const NAME = 'schema:DateTime';
    public const PARENTS = [];
    public const ENUMERATION_MEMBERS = [];

    public function __construct()
    {
    }
}
