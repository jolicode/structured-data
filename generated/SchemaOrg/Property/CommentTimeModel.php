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

final class CommentTimeModel
{
    public const DESCRIPTION = 'The time at which the UserComment was made.';
    public const LABEL = 'commentTime';
    public const NAME = 'schema:commentTime';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel', 'DateTimeModel' => 'SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['UserComments' => 'SchemaOrg\Type\UserCommentsModel'];
}
