<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Type;

use Jolicode\SchemaOrg\Property;

final class DayOfWeekModel
{
    public const DESCRIPTION = 'The day of the week, e.g. used to specify to which day the opening hours of an OpeningHoursSpecification refer.

Originally, URLs from [GoodRelations](http://purl.org/goodrelations/v1) were used (for [[Monday]], [[Tuesday]], [[Wednesday]], [[Thursday]], [[Friday]], [[Saturday]], [[Sunday]] plus a special entry for [[PublicHolidays]]); these have now been integrated directly into schema.org.';
    public const LABEL = 'DayOfWeek';
    public const NAME = 'schema:DayOfWeek';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['FridayModel' => 'EnumerationMember\FridayModel', 'MondayModel' => 'EnumerationMember\MondayModel', 'PublicHolidaysModel' => 'EnumerationMember\PublicHolidaysModel', 'SaturdayModel' => 'EnumerationMember\SaturdayModel', 'SundayModel' => 'EnumerationMember\SundayModel', 'ThursdayModel' => 'EnumerationMember\ThursdayModel', 'TuesdayModel' => 'EnumerationMember\TuesdayModel', 'WednesdayModel' => 'EnumerationMember\WednesdayModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
