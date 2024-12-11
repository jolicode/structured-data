<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class GovernmentBenefitsInfoModel
{
    public const DESCRIPTION = 'governmentBenefitsInfo provides information about government benefits associated with a SpecialAnnouncement.';
    public const LABEL = 'governmentBenefitsInfo';
    public const NAME = 'schema:governmentBenefitsInfo';
    public const VALUES = ['GovernmentServiceModel' => 'Jolicode\SchemaOrg\Type\GovernmentServiceModel'];
    public const TYPES = ['SpecialAnnouncement' => 'Jolicode\SchemaOrg\Type\SpecialAnnouncementModel'];
}
