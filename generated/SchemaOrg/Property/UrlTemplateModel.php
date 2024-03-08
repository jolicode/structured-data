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

final class UrlTemplateModel
{
    public const DESCRIPTION = 'An url template (RFC6570) that will be used to construct the target of the execution of the action.';
    public const LABEL = 'urlTemplate';
    public const NAME = 'schema:urlTemplate';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['EntryPoint' => 'SchemaOrg\\Type\\EntryPointModel'];
}
