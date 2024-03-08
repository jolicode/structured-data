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

final class ResultReviewModel
{
    public const DESCRIPTION = 'A sub property of result. The review that resulted in the performing of the action.';
    public const LABEL = 'resultReview';
    public const NAME = 'schema:resultReview';
    public const VALUES = ['ReviewModel' => 'SchemaOrg\\Type\\ReviewModel'];
    public const TYPES = ['ReviewAction' => 'SchemaOrg\\Type\\ReviewActionModel'];
}
