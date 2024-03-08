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

final class SubTestModel
{
    public const DESCRIPTION = 'A component test of the panel.';
    public const LABEL = 'subTest';
    public const NAME = 'schema:subTest';
    public const VALUES = ['MedicalTestModel' => 'SchemaOrg\\Type\\MedicalTestModel'];
    public const TYPES = ['MedicalTestPanel' => 'SchemaOrg\\Type\\MedicalTestPanelModel'];
}
