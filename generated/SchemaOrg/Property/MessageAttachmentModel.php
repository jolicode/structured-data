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

final class MessageAttachmentModel
{
    public const DESCRIPTION = 'A CreativeWork attached to the message.';
    public const LABEL = 'messageAttachment';
    public const NAME = 'schema:messageAttachment';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel'];
    public const TYPES = ['Message' => 'SchemaOrg\\Type\\MessageModel'];
}
