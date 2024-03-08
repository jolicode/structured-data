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

final class ReplyToUrlModel
{
    public const DESCRIPTION = 'The URL at which a reply may be posted to the specified UserComment.';
    public const LABEL = 'replyToUrl';
    public const NAME = 'schema:replyToUrl';
    public const VALUES = ['URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['UserComments' => 'SchemaOrg\\Type\\UserCommentsModel'];
}
