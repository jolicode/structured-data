<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class DownvoteCountModel
{
    public const DESCRIPTION = 'The number of downvotes this question, answer or comment has received from the community.';
    public const LABEL = 'downvoteCount';
    public const NAME = 'schema:downvoteCount';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\\Type\\IntegerModel'];
    public const TYPES = ['Comment' => 'SchemaOrg\\Type\\CommentModel'];
}
