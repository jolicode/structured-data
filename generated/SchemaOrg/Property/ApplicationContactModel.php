<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ApplicationContactModel
{
    public const DESCRIPTION = 'Contact details for further information relevant to this job posting.';
    public const LABEL = 'applicationContact';
    public const NAME = 'schema:applicationContact';
    public const VALUES = ['ContactPointModel' => 'SchemaOrg\Type\ContactPointModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\Type\JobPostingModel'];
}
