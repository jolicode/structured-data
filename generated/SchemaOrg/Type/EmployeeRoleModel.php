<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Type;

use SchemaOrg\Property;

final class EmployeeRoleModel
{
    public const DESCRIPTION = 'A subclass of OrganizationRole used to describe employee relationships.';
    public const LABEL = 'EmployeeRole';
    public const NAME = 'schema:EmployeeRole';
    public const PARENTS = ['OrganizationRoleModel' => 'SchemaOrg\Type\OrganizationRoleModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\BaseSalaryModel $baseSalary = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\EndDateModel $endDate = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\NamedPositionModel $namedPosition = null,
        public ?Property\NumberedPositionModel $numberedPosition = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\RoleNameModel $roleName = null,
        public ?Property\SalaryCurrencyModel $salaryCurrency = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\StartDateModel $startDate = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
