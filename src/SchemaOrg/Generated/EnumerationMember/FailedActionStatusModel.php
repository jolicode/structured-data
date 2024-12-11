<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\EnumerationMember;

final class FailedActionStatusModel
{
    public const DESCRIPTION = 'An action that failed to complete. The action\'s error property and the HTTP return code contain more information about the failure.';
    public const LABEL = 'FailedActionStatus';
    public const NAME = 'schema:FailedActionStatus';
}
