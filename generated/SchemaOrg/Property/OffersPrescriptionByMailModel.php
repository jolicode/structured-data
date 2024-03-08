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

final class OffersPrescriptionByMailModel
{
    public const DESCRIPTION = 'Whether prescriptions can be delivered by mail.';
    public const LABEL = 'offersPrescriptionByMail';
    public const NAME = 'schema:offersPrescriptionByMail';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\\Type\\BooleanModel'];
    public const TYPES = ['HealthPlanFormulary' => 'SchemaOrg\\Type\\HealthPlanFormularyModel'];
}
