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

final class UpvoteCountModel
{
    public const DESCRIPTION = 'The number of upvotes this question, answer or comment has received from the community.';
    public const LABEL = 'upvoteCount';
    public const NAME = 'schema:upvoteCount';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Comment' => 'SchemaOrg\Type\CommentModel'];
}
