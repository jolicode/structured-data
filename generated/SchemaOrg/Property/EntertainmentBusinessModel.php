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

final class EntertainmentBusinessModel
{
    public const DESCRIPTION = 'A sub property of location. The entertainment business where the action occurred.';
    public const LABEL = 'entertainmentBusiness';
    public const NAME = 'schema:entertainmentBusiness';
    public const VALUES = ['EntertainmentBusinessModel' => 'SchemaOrg\\Type\\EntertainmentBusinessModel'];
    public const TYPES = ['PerformAction' => 'SchemaOrg\\Type\\PerformActionModel'];
}
