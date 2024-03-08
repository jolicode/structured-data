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

namespace SchemaOrg\EnumerationMember;

final class SatireOrParodyContentModel
{
    public const DESCRIPTION = 'Content coded \'satire or parody content\' in a [[MediaReview]], considered in the context of how it was published or shared.

For a [[VideoObject]] to be \'satire or parody content\': A video that was created as political or humorous commentary and is presented in that context. (Reshares of satire/parody content that do not include relevant context are more likely to fall under the “missing context” rating.)

For an [[ImageObject]] to be \'satire or parody content\': An image that was created as political or humorous commentary and is presented in that context. (Reshares of satire/parody content that do not include relevant context are more likely to fall under the “missing context” rating.)

For an [[ImageObject]] with embedded text to be \'satire or parody content\': An image that was created as political or humorous commentary and is presented in that context. (Reshares of satire/parody content that do not include relevant context are more likely to fall under the “missing context” rating.)

For an [[AudioObject]] to be \'satire or parody content\': Audio that was created as political or humorous commentary and is presented in that context. (Reshares of satire/parody content that do not include relevant context are more likely to fall under the “missing context” rating.)
';
    public const LABEL = 'SatireOrParodyContent';
    public const NAME = 'schema:SatireOrParodyContent';
}
