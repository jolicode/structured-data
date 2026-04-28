<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\Google;

final class JobPosting
{
    public const NAME = 'JobPosting';
    public const SUPPORTED_TYPES = ['JobPosting'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/job-posting';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = true;
    public const SPECIAL_RULE_KEYS = ['google.job_posting.remote_job_location_requirements'];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = ['title' => ['name' => 'title', 'severity' => 'required', 'supportedTypes' => ['Text']], 'description' => ['name' => 'description', 'severity' => 'required', 'supportedTypes' => ['Text']], 'datePosted' => ['name' => 'datePosted', 'severity' => 'required', 'supportedTypes' => ['Date']], 'hiringOrganization' => ['name' => 'hiringOrganization', 'severity' => 'required', 'supportedTypes' => ['Organization'], 'properties' => ['name' => ['name' => 'name', 'severity' => 'required', 'supportedTypes' => ['Text']], 'sameAs' => ['name' => 'sameAs', 'severity' => 'recommended', 'supportedTypes' => ['URL']], 'logo' => ['name' => 'logo', 'severity' => 'recommended', 'supportedTypes' => ['URL', 'ImageObject']]]], 'jobLocation' => ['name' => 'jobLocation', 'severity' => 'required', 'supportedTypes' => ['Place'], 'properties' => ['address' => ['name' => 'address', 'severity' => 'required', 'supportedTypes' => ['PostalAddress'], 'properties' => ['streetAddress' => ['name' => 'streetAddress', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'addressLocality' => ['name' => 'addressLocality', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'addressRegion' => ['name' => 'addressRegion', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'postalCode' => ['name' => 'postalCode', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'addressCountry' => ['name' => 'addressCountry', 'severity' => 'required', 'supportedTypes' => ['Text']]]]]], 'identifier' => ['name' => 'identifier', 'severity' => 'recommended', 'supportedTypes' => ['PropertyValue'], 'properties' => ['name' => ['name' => 'name', 'severity' => 'required', 'supportedTypes' => ['Text']], 'value' => ['name' => 'value', 'severity' => 'required', 'supportedTypes' => ['Text']]]], 'validThrough' => ['name' => 'validThrough', 'severity' => 'recommended', 'supportedTypes' => ['DateTime']], 'employmentType' => ['name' => 'employmentType', 'severity' => 'recommended', 'supportedTypes' => ['Text'], 'value' => ['FULL_TIME', 'PART_TIME', 'CONTRACTOR', 'TEMPORARY', 'INTERN', 'VOLUNTEER', 'PER_DIEM', 'OTHER']], 'directApply' => ['name' => 'directApply', 'severity' => 'recommended', 'supportedTypes' => ['Boolean']], 'jobLocationType' => ['name' => 'jobLocationType', 'severity' => 'optional', 'supportedTypes' => ['Text'], 'value' => ['TELECOMMUTE']], 'applicantLocationRequirements' => ['name' => 'applicantLocationRequirements', 'severity' => 'optional', 'supportedTypes' => ['AdministrativeArea', 'Country', 'State'], 'properties' => ['name' => ['name' => 'name', 'severity' => 'required', 'supportedTypes' => ['Text']]]]];
}
